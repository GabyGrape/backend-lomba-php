<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Product;
use App\Models\Cart;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
//     public function store(Request $request)
// {
//     // 1. Validasi Input (Ganti menu_id menjadi product_id agar konsisten)
//     $validator = Validator::make($request->all(), [
//         'merchant_id'      => 'required|exists:users_,id',
//         'total_price'      => 'required|numeric',
//         'pickup_plan_at'   => 'nullable|date',
//         'items'            => 'required|array',
//         'items.*.product_id' => 'required|exists:products_,id', // Konsisten pakai product_id
//         'items.*.quantity'   => 'required|integer|min:1',
//         'items.*.price'      => 'required|numeric',
//     ]);

//     if ($validator->fails()) {
//         return response()->json($validator->errors(), 422);
//     }

//     return DB::transaction(function () use ($request) {
//         // 2. Buat Header Order
//         $order = Order::create([
//             'user_id'        => auth()->id() ?? $request->user_id,
//             'merchant_id'    => $request->merchant_id,
//             'total_price'    => $request->total_price,
//             'pickup_plan_at' => $request->pickup_plan_at,
//             'status_id'      => 1,
//         ]);

//         // 3. Buat Items (Detail)
//         foreach ($request->items as $item) {
//             $order->items()->create([
//                 // Panggil sesuai dengan nama di validasi & JSON input
//                 'product_id'        => $item['product_id'], 
//                 'quantity'          => $item['quantity'],
//                 'price_at_purchase' => $item['price'],
//             ]);
//         }

//         return response()->json([
//             'message' => 'Order created successfully', 
//             'data' => $order->load('items')
//         ], 201);
//     });
// }
public function store(Request $request)
    {
        // 1. Validasi awal: merchant_id tetap wajib tahu mau pesan ke siapa
        $validator = Validator::make($request->all(), [
            'merchant_id'    => 'required|exists:users_,id',
            'pickup_plan_at' => 'nullable|date',
            // 'items' jadi optional, karena kalau kosong kita ambil dari Cart
            'items'          => 'nullable|array',
            'items.*.product_id' => 'required_with:items|exists:products_,id',
            'items.*.quantity'   => 'required_with:items|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        return DB::transaction(function () use ($request) {
            $orderItemsData = [];
            $totalPrice = 0;
            $userId = auth()->id() ?? $request->user_id;

            // --- LOGIKA PENENTUAN SUMBER DATA ---
            
            if ($request->has('items') && !empty($request->items)) {
                // SKENARIO A: DIRECT BUY (Beli Langsung)
                foreach ($request->items as $item) {
                    $product = Product::findOrFail($item['product_id']);
                    $itemPrice = $product->harga;
                    $subTotal = $itemPrice * $item['quantity'];

                    $orderItemsData[] = [
                        'product_id'        => $item['product_id'],
                        'quantity'          => $item['quantity'],
                        'price_at_purchase' => $itemPrice,
                    ];
                    $totalPrice += $subTotal;
                }
            } else {
                // SKENARIO B: CHECKOUT DARI CART
                $cartItems = Cart::where('user_id', $userId)->get();

                if ($cartItems->isEmpty()) {
                    return response()->json(['message' => 'Keranjang kosong atau item tidak ditemukan'], 400);
                }

                foreach ($cartItems as $cart) {
                    $orderItemsData[] = [
                        'product_id'        => $cart->product_id,
                        'quantity'          => $cart->qty,
                        'price_at_purchase' => $cart->price,
                    ];
                    $totalPrice += ($cart->price * $cart->qty);
                }

                // Hapus data di keranjang karena sudah jadi Order
                Cart::where('user_id', $userId)->delete();
            }

            // 2. Buat Header Order
            $order = Order::create([
                'user_id'        => $userId,
                'merchant_id'    => $request->merchant_id,
                'total_price'    => $totalPrice, // Total dihitung di server (aman dari manipulasi)
                'pickup_plan_at' => $request->pickup_plan_at,
                'status_id'      => 1, // Default: Pending/Menunggu Pembayaran
            ]);

            // 3. Simpan Detail Items
            foreach ($orderItemsData as $item) {
                $order->items()->create($item);
            }

            return response()->json([
                'message' => 'Order created successfully', 
                'data' => $order->load('items.product')
            ], 201);
        });
    }

// 1. Ambil SEMUA Order (Admin)
public function index() {
    return response()->json(Order::with(['items.product', 'customer', 'merchant'])->get());
}

// 2. Ambil Order berdasarkan User (History Belanja)
public function getByUserId($id) {
    $orders = Order::where('user_id', $id)->with('items.product')->latest()->get();
    return response()->json($orders);
}

// public function getUserHistory(Request $request) {
//     // Tidak perlu kirim ID di URL, ambil langsung dari user yang login
//     return Order::where('user_id', $request->user()->id)->with('items.product')->get();
// }

// public function getMerchantOrders(Request $request) {
//     return Order::where('merchant_id', $request->user()->id)->with('items.product', 'customer')->get();
// }
public function getUserHistory(Request $request) {
    // Mengambil order di mana user ini adalah pembelinya
    $orders = Order::where('user_id', $request->user()->id)
        ->with(['items.product', 'merchant']) // sertakan data barang dan warungnya
        ->latest()
        ->get();

    return response()->json($orders);
}

public function getMerchantOrders(Request $request) {
    // Mengambil order yang masuk ke warung milik user ini
    $orders = Order::where('merchant_id', $request->user()->id)
        ->with(['items.product', 'customer']) // sertakan data barang dan siapa pembelinya
        ->latest()
        ->get();

    return response()->json($orders);
}
// 3. Ambil Order masuk untuk Merchant (Dashboard Warung)
public function getByMerchantId($id) {
    $orders = Order::where('merchant_id', $id)->with(['items.product', 'customer'])->latest()->get();
    return response()->json($orders);
}

// 4. Update Status (Misal: Selesaikan Pesanan)
public function updateStatus(Request $request, $id) {
    $order = Order::findOrFail($id);
    $order->update(['status' => $request->status]); // misal kirim status: 'completed'
    return response()->json(['message' => 'Status updated', 'data' => $order]);
}
// public function completeOrder($orderId)
// {
//     return DB::transaction(function () use ($orderId) {
//         $order = Order::with('items')->findOrFail($orderId);
        
//         if ($order->status === 'completed') return; // Avoid double count

//         $totalCogs = 0;

//         foreach ($order->items as $item) {
//             // Ambil harga modal rata-rata dari inventory_stocks
//             $stock = InventoryStock::where('merchant_id', $order->merchant_id)
//                 ->where('product_name', $item->product_name) // Pastikan relasi ke produk benar
//                 ->first();

//             if ($stock) {
//                 $cogsForItem = $item->quantity * $stock->average_unit_price;
//                 $totalCogs += $cogsForItem;

//                 // Kurangi stok fisik
//                 $stock->decrement('total_quantity', $item->quantity);
//                 $stock->total_inventory_value = $stock->total_quantity * $stock->average_unit_price;
//                 $stock->save();
//             }
//         }

//         $order->status = 'completed';
//         $order->save();

//         // Update Laporan Harian
//         $report = DailyFinancialReport::firstOrCreate([
//             'merchant_id' => $order->merchant_id,
//             'report_date' => now()->toDateString()
//         ]);

//         $report->total_sales += $order->total_price;
//         $report->total_cogs += $totalCogs;
//         $report->gross_profit = $report->total_sales - $report->total_cogs;
//         $report->net_profit = $report->gross_profit - $report->monthly_expenses;
//         $report->save();

//         return response()->json(['message' => 'Laporan Terupdate']);
//     });
// }
public function completeOrder($orderId)
{
    return DB::transaction(function () use ($orderId) {
        // 1. Cek apakah Order ada (Tanpa memicu 404 otomatis)
        $order = Order::with('items.product')->find($orderId);

        if (!$order) {
            return response()->json([
                'status' => 'error',
                'message' => "Order dengan ID $orderId tidak ditemukan di database."
            ], 404);
        }

        // 2. Proteksi: jangan proses jika sudah completed
        // Gunakan status_id atau status sesuai kolom di tabelmu
        if ($order->status == 'completed' || $order->status_id == 3) { 
            return response()->json(['message' => 'Order sudah diproses sebelumnya'], 400);
        }

        $totalCogsForOrder = 0;

        foreach ($order->items as $item) {
            // Pastikan relasi 'product' ada di model OrderItem
            if (!$item->product) {
                continue; // Skip jika item tidak punya relasi produk
            }

            // 3. Cari Stok
            $stock = \App\Models\InventoryStock::where('merchant_id', $order->merchant_id)
                ->where('product_name', $item->product->name) 
                ->first();

            if ($stock) {
                // Hitung COGS
                $totalCogsForOrder += ($item->quantity * $stock->average_unit_price);

                // Kurangi Stok
                $stock->decrement('total_quantity', $item->quantity);
                $stock->total_inventory_value = $stock->total_quantity * $stock->average_unit_price;
                $stock->save();
            }
        }

        // 4. Update Status Order (Sesuaikan kolomnya: status atau status_id)
        $order->update(['status' => 'completed']);

        // 5. Update Laporan Keuangan Harian
        $report = \App\Models\DailyFinancialReport::firstOrCreate([
            'merchant_id' => $order->merchant_id,
            'report_date' => $order->created_at->toDateString()
        ]);

        $report->increment('total_sales', $order->total_price);
        $report->increment('total_cogs', $totalCogsForOrder);
        
        $report->gross_profit = $report->total_sales - $report->total_cogs;
        $report->net_profit = $report->gross_profit - $report->monthly_expenses;
        $report->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Laporan Laba Rugi Terupdate',
            'data' => [
                'order_id' => $order->id,
                'total_sales' => $order->total_price,
                'total_cogs' => $totalCogsForOrder,
                'profit' => $order->total_price - $totalCogsForOrder
            ]
        ]);
    });
}

// public function completeOrder($orderId)
// {
//     // Hapus semua logic, sisakan ini saja untuk tes
//     return response()->json([
//         'message' => 'Rute berhasil diakses!',
//         'id_yang_dikirim' => $orderId
//     ]);
// }

}