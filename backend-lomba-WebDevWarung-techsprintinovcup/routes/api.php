<?php 

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;
use Illuminate\Http\Request;

Route::get('/products', [ProductController::class, 'index']);
Route::post('/products', [ProductController::class, 'store']);

// Route Publik (Bisa diakses tanpa login)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Route Terproteksi (Harus bawa Token)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

});

// Route Forgot Password (Opsi A)
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

// User Management
// Route yang WAJIB login
Route::middleware('auth:sanctum')->group(function () {
    
    // Logout harus di dalam sini karena kita perlu tahu siapa yang logout
    Route::post('/logout', [AuthController::class, 'logout']);

    // Endpoint Update Profile (BARU)
    Route::put('/user/profile', [AuthController::class, 'updateProfile']);

    // Endpoint Management User
    Route::get('/users', [AuthController::class, 'getAllUsers']);
    Route::get('/users/search', [AuthController::class, 'getUserByEmail']);
    Route::get('/users/{id}', [AuthController::class, 'getUserById']);
    
    // Jika kamu ingin namanya 'carts' (pakai s), tulis begini:
    Route::post('/carts', [CartController::class, 'addToCart']);
    Route::get('/carts', [CartController::class, 'getMyCart']);
    Route::post('/user/qris', [AuthController::class, 'updateQris']);
    
    // Untuk Konsumen
    Route::post('/orders', [OrderController::class, 'store']);      // Buat pesanan baru
    Route::get('/orders/history', [OrderController::class, 'index']); // Lihat riwayat belanja

    // Untuk Pedagang (Merchant)
    Route::get('/merchant/orders', [OrderController::class, 'merchantIndex']); // List pesanan masuk
    Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus']); // Update status (ongoing/completed/dll)


    // Route untuk mengambil SEMUA order (biasanya untuk Admin)
    Route::get('/orders', [OrderController::class, 'index']);
    
    // Route untuk membuat order baru (yang sudah kamu buat sebelumnya)
    Route::post('/orders', [OrderController::class, 'store']);
    
    // Route untuk history belanja USER (Pelanggan)
    Route::get('/orders/user/{id}', [OrderController::class, 'getByUserId']);
    
    // Route untuk pesanan masuk MERCHANT (Warung)
    Route::get('/orders/merchant/{id}', [OrderController::class, 'getByMerchantId']);
    
    // Route untuk update status (PUT/PATCH)
    Route::patch('/orders/{id}/status', [OrderController::class, 'updateStatus']);
    
    });

Route::apiResource('products', ProductController::class);