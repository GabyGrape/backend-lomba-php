<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function store(Request $request)
{
    // 1. Validasi Input (Ganti menu_id menjadi product_id agar konsisten)
    $validator = Validator::make($request->all(), [
        'merchant_id'      => 'required|exists:users_,id',
        'total_price'      => 'required|numeric',
        'pickup_plan_at'   => 'nullable|date',
        'items'            => 'required|array',
        'items.*.product_id' => 'required|exists:products_,id', // Konsisten pakai product_id
        'items.*.quantity'   => 'required|integer|min:1',
        'items.*.price'      => 'required|numeric',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    return DB::transaction(function () use ($request) {
        // 2. Buat Header Order
        $order = Order::create([
            'user_id'        => auth()->id() ?? $request->user_id,
            'merchant_id'    => $request->merchant_id,
            'total_price'    => $request->total_price,
            'pickup_plan_at' => $request->pickup_plan_at,
            'status_id'      => 1,
        ]);

        // 3. Buat Items (Detail)
        foreach ($request->items as $item) {
            $order->items()->create([
                // Panggil sesuai dengan nama di validasi & JSON input
                'product_id'        => $item['product_id'], 
                'quantity'          => $item['quantity'],
                'price_at_purchase' => $item['price'],
            ]);
        }

        return response()->json([
            'message' => 'Order created successfully', 
            'data' => $order->load('items')
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