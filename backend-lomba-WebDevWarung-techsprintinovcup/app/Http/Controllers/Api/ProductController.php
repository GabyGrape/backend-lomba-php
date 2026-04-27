<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // GET: List semua produk
    public function index()
    {
        $products = Product::all();
        return response()->json(['data' => $products], 200);
    }

    // POST: Simpan produk baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_menu' => 'required',
            'harga'     => 'required|numeric',
            'stok'      => 'required|integer',
            'kategori'  => 'required',
            'user_id'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $product = Product::create($request->all());
        return response()->json(['message' => 'Produk berhasil dibuat', 'data' => $product], 201);
    }

    // GET: Detail satu produk
    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        
        return response()->json(['data' => $product], 200);
    }

    // PUT/PATCH: Update produk
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) return response()->json(['message' => 'Produk tidak ditemukan'], 404);

        $product->update($request->all());
        return response()->json(['message' => 'Produk berhasil diupdate', 'data' => $product], 200);
    }

    // DELETE: Hapus produk
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) return response()->json(['message' => 'Produk tidak ditemukan'], 404);

        $product->delete();
        return response()->json(['message' => 'Produk berhasil dihapus'], 200);
    }
}