<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // GET: List semua produk
    public function index(Request $request)
{
    // Mengambil user_id (pedagang) dari query string, misal: /api/products?user_id=1
    $userId = $request->query('user_id');

    if ($userId) {
        $products = Product::where('user_id', $userId)->get();
    } else {
        // Jika tidak ada user_id, mungkin tampilkan semua atau beri error
        $products = Product::all(); 
    }

    // Pastikan gambar_url juga muncul di index
    $products->each(function($product) {
        $product->gambar_url = $product->gambar ? asset('storage/' . $product->gambar) : null;
    });

    return response()->json(['data' => $products], 200);
}

    // POST: Simpan produk baru
    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'nama_menu'   => 'required|string',
        'harga'       => 'required|numeric',
        'stok'        => 'required|integer',
        'category_id' => 'required|exists:categories,id',
        'user_id'     => 'required|exists:users_,id',
        'gambar'      => 'required|image|mimes:png,jpg,jpeg|max:2048', // Validasi Gambar
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    $data = $request->all();

    // Logika Simpan Gambar
    if ($request->hasFile('gambar')) {
        $path = $request->file('gambar')->store('products', 'public');
        $data['gambar'] = $path; // Simpan path ke kolom 'gambar'
    }

    $product = Product::create($data);
    
    // Tambahkan URL lengkap untuk response
    $product->gambar_url = asset('storage/' . $product->gambar);

    return response()->json([
        'message' => 'Produk berhasil dibuat', 
        'data' => $product
    ], 201);
}

    // GET: Detail satu produk
    public function show($id)
{
    $product = Product::find($id);
    if (!$product) return response()->json(['message' => 'Produk tidak ditemukan'], 404);
    
    // Buat URL Gambar
    $product->gambar_url = $product->gambar ? asset('storage/' . $product->gambar) : null;
    
    return response()->json(['data' => $product], 200);
}

    // PUT/PATCH: Update produk
    public function update(Request $request, $id)
{
    $product = Product::find($id);
    if (!$product) return response()->json(['message' => 'Produk tidak ditemukan'], 404);

    $data = $request->all();

    if ($request->hasFile('gambar')) {
        // Hapus gambar lama jika ada
        if ($product->gambar && \Storage::disk('public')->exists($product->gambar)) {
            \Storage::disk('public')->delete($product->gambar);
        }
        
        $path = $request->file('gambar')->store('products', 'public');
        $data['gambar'] = $path;
    }

    $product->update($data);
    return response()->json(['message' => 'Produk berhasil diupdate', 'data' => $product], 200);
}

    // DELETE: Hapus produk
    public function destroy($id)
{
    $product = Product::find($id);
    if (!$product) return response()->json(['message' => 'Produk tidak ditemukan'], 404);

    // Cek apakah user yang login adalah pemilik produk ini
    // (Asumsi kamu sudah pakai authentication seperti Sanctum)
    if ($product->user_id !== auth()->id()) {
        return response()->json(['message' => 'Anda tidak berhak menghapus produk ini'], 403);
    }

    // Hapus file gambar dari storage sebelum hapus record di DB
    if ($product->gambar) {
        \Storage::disk('public')->delete($product->gambar);
    }

    $product->delete();
    return response()->json(['message' => 'Produk berhasil dihapus'], 200);
}
}