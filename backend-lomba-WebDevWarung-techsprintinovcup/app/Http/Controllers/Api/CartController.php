<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product; // WAJIB ADA
use App\Models\Cart;    // WAJIB ADA
use Illuminate\Support\Facades\DB; // Untuk DB::raw

class CartController extends Controller
{
    /**
     * Tambah produk ke keranjang (Login Required)
     */
    public function addToCart(Request $request)
{
    $fields = $request->validate([
        'product_id' => 'required|exists:products_,id',
        'qty' => 'required|integer|min:1',
    ]);

    $product = Product::find($fields['product_id']);

    // Cek stok
    if ($product->stok < $fields['qty']) {
        return response(['message' => 'Stok tidak mencukupi'], 400);
    }

    // CARA AMAN UNTUK SQLITE:
    // 1. Cek dulu apakah barangnya sudah ada di keranjang user ini
    $cartItem = Cart::where('user_id', $request->user()->id)
                    ->where('product_id', $fields['product_id'])
                    ->first();

    if ($cartItem) {
        // 2. Jika ADA, gunakan increment (Laravel otomatis handle qty + n)
        $cartItem->increment('qty', $fields['qty']);
        // Update harga terbaru juga kalau perlu
        $cartItem->update(['price' => $product->harga]);
    } else {
        // 3. Jika TIDAK ADA, lakukan Create (Insert)
        $cartItem = Cart::create([
            'user_id'     => $request->user()->id,
            'product_id'  => $fields['product_id'],
            'pedagang_id' => $product->user_id, 
            'price'       => $product->harga,
            'qty'         => $fields['qty'],
        ]);
    }

    return response([
        'message' => 'Berhasil ditambah ke keranjang',
        'data'    => $cartItem->fresh() 
    ], 201);
}
    /**
     * Lihat isi keranjang sendiri
     */
    public function getMyCart(Request $request)
    {
        // Pastikan di Model Cart sudah ada method product()
        $cart = Cart::with('product')->where('user_id', $request->user()->id)->get();

        $totalHarga = $cart->sum(function ($item) {
            return $item->qty * $item->price;
        });

        return response([
            'message' => 'Daftar keranjang belanja',
            'cart' => $cart,
            'total_pembayaran' => $totalHarga
        ], 200);
    }
}
