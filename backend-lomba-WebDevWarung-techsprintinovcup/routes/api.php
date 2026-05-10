<?php 

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

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

});//dashboard
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
    Route::post('/user/qris', [AuthController::class, 'updateQris']);
    
  


Route::apiResource('products', ProductController::class);