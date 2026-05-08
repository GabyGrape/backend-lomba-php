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
}