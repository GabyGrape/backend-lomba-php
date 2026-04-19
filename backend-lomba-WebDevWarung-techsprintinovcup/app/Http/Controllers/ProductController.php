<?php

// namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;

// class ProductController extends Controller
// {
    //
// }
namespace App\Http\Controllers;

use App\Models\Product; // Jangan lupa import modelnya
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() 
    {
        // Ambil semua data produk dari database
        $products = Product::all();
        
        // Kirim sebagai JSON
        return response()->json($products);
    }
    public function store(Request $request) 
{
    // 1. Validasi data yang masuk
    $validated = $request->validate([
        'name' => 'required|string',
        'stock' => 'required|integer',
        'price' => 'required|numeric',
    ]);

    // 2. Simpan ke database
    $product = Product::create($validated);

    // 3. Kasih respon sukses ke FE
    return response()->json([
        'message' => 'Produk berhasil ditambah!',
        'data' => $product
    ], 201);
}
}