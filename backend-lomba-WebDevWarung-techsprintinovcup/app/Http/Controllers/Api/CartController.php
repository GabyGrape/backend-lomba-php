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
     * 1. Get All Carts (Untuk Admin - Melihat semua keranjang yang aktif)
     */
    public function index()
    {
        $carts = Cart::with(['product', 'user'])->get();
        return response()->json([
            'message' => 'Semua data keranjang aktif',
            'data' => $carts
        ]);
    }

    /**
     * 2. Get Carts by Pedagang ID (Untuk role Pedagang/Merchant)
     * Ini berguna untuk melihat barang apa saja milik mereka yang sedang "parkir" di keranjang orang lain.
     */
    public function getByPedagangId($pedagang_id)
    {
        $carts = Cart::with(['product', 'user'])
                    ->where('pedagang_id', $pedagang_id)
                    ->get();

        if ($carts->isEmpty()) {
            return response()->json(['message' => 'Belum ada produk Anda di keranjang manapun'], 200);
        }

        return response()->json([
            'message' => 'Daftar produk Anda di keranjang pelanggan',
            'pedagang_id' => $pedagang_id,
            'data' => $carts
        ]);
    }
    /**
     * Tambah produk ke keranjang (Login Required)
     */
//     public function addToCart(Request $request)
// {
//     $fields = $request->validate([
//         'product_id' => 'required|exists:products_,id',
//         'qty' => 'required|integer|min:1',
//     ]);

//     $product = Product::find($fields['product_id']);

//     // Cek stok
//     if ($product->stok < $fields['qty']) {
//         return response(['message' => 'Stok tidak mencukupi'], 400);
//     }

//     // CARA AMAN UNTUK SQLITE:
//     // 1. Cek dulu apakah barangnya sudah ada di keranjang user ini
//     $cartItem = Cart::where('user_id', $request->user()->id)
//                     ->where('product_id', $fields['product_id'])
//                     ->first();

//     if ($cartItem) {
//         // 2. Jika ADA, gunakan increment (Laravel otomatis handle qty + n)
//         $cartItem->increment('qty', $fields['qty']);
//         // Update harga terbaru juga kalau perlu
//         $cartItem->update(['price' => $product->harga]);
//     } else {
//         // 3. Jika TIDAK ADA, lakukan Create (Insert)
//         $cartItem = Cart::create([
//             'user_id'     => $request->user()->id,
//             'product_id'  => $fields['product_id'],
//             'pedagang_id' => $product->user_id, 
//             'price'       => $product->harga,
//             'qty'         => $fields['qty'],
//         ]);
//     }

//     return response([
//         'message' => 'Berhasil ditambah ke keranjang',
//         'data'    => $cartItem->fresh() 
//     ], 201);
// }
public function addToCart(Request $request)
{
    // 1. Pastikan User sudah login sebelum lanjut
    $user = $request->user();
    if (!$user) {
        return response()->json(['message' => 'Silahkan login terlebih dahulu'], 401);
    }

    // 2. Validasi Input
    $fields = $request->validate([
        'product_id' => 'required|exists:products_,id',
        'qty'        => 'required|integer|min:1',
    ]);

    // 3. Ambil data produk dan pastikan produknya ada
    $product = Product::find($fields['product_id']);
    if (!$product) {
        return response()->json(['message' => 'Produk tidak ditemukan'], 404);
    }

    // 4. Cek Stok (Penting agar tidak over-order)
    if ($product->stok < $fields['qty']) {
        return response()->json(['message' => "Stok tidak mencukupi. Sisa stok: $product->stok"], 400);
    }

    // 5. Logika Tambah/Update Keranjang
    // Kita simpan di variabel agar bisa dikembalikan di response
    $cartItem = Cart::where('user_id', $user->id)
                    ->where('product_id', $fields['product_id'])
                    ->first();

    if ($cartItem) {
        // Jika sudah ada, tambah qty dan update harga terbaru
        $cartItem->increment('qty', $fields['qty']);
        $cartItem->update(['price' => $product->harga]);
    } else {
        // Jika belum ada, buat record baru
        $cartItem = Cart::create([
            'user_id'     => $user->id,
            'product_id'  => $fields['product_id'],
            'pedagang_id' => $product->user_id, // Mengambil ID pemilik produk
            'price'       => $product->harga,
            'qty'         => $fields['qty'],
        ]);
    }

    // 6. Return response dengan data terbaru
    return response()->json([
        'message' => 'Berhasil ditambah ke keranjang',
        'data'    => $cartItem->fresh(['product']) // Me-load relasi produk agar infonya lengkap
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
