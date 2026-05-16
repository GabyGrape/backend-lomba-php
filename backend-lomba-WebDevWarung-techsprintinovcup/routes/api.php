<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\PurchaseController;
use App\Http\Controllers\Api\MonthlyExpenseController;
use App\Http\Controllers\Api\FinancialReportController;

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

    // // 1. Lihat keranjang sendiri
    // Route::get('cart/my', [CartController::class, 'getMyCart']);
    
    // // 2. Tambah ke keranjang
    // Route::post('cart/add', [CartController::class, 'addToCart']);
    
    // // 3. Lihat berdasarkan Merchant (Untuk Pedagang)
    // Route::get('cart/merchant/{pedagang_id}', [CartController::class, 'getByPedagangId']);
    Route::post('cart/add', [CartController::class, 'addToCart']);
    Route::get('cart/my', [CartController::class, 'getMyCart']);
    Route::get('cart/merchant/{pedagang_id}', [CartController::class, 'getByPedagangId']);

    // 4. Lihat semua (Admin)
    Route::get('cart/all', [CartController::class, 'index']);
    
    Route::post('/user/qris', [AuthController::class, 'updateQris']);

});
//dashboard

Route::get('/dashboard/seller', fn() => view('dashboard.dashboard_seller'));

// Route Forgot Password (Opsi A)
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);



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

Route::apiResource('products', ProductController::class);
Route::get('/healthz', function () {
    return response('OK', 200);
});
use Illuminate\Support\Facades\Artisan;

Route::get('/emergency-migrate', function () {
    try {
        Artisan::call('migrate --force');
        Artisan::call('config:clear');
        return response()->json(['message' => 'Migration Success', 'output' => Artisan::output()]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});
// Route untuk menyelesaikan pesanan
Route::post('/orders/{id}/complete', [OrderController::class, 'completeOrder']);


Route::apiResource('purchases', PurchaseController::class);
Route::apiResource('expenses', MonthlyExpenseController::class);


// Route untuk melihat ringkasan laporan keuangan
Route::get('/reports/finance-summary', [FinancialReportController::class, 'index']);