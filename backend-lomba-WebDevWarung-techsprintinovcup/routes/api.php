<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\PurchaseController;
use App\Http\Controllers\Api\MonthlyExpenseController;
use Illuminate\Support\Facades\Artisan;

// ============================================================
// PUBLIC ROUTES (Tidak perlu token)
// ============================================================

// Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

// Forgot & Reset Password
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password',  [AuthController::class, 'resetPassword']);

// Products (publik, bisa dilihat tanpa login)
Route::get('/products',      [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);

// Health Check
Route::get('/healthz', fn() => response('OK', 200));

// Emergency Migrate (development only, hapus di production)
Route::get('/emergency-migrate', function () {
    try {
        Artisan::call('migrate --force');
        Artisan::call('config:clear');
        return response()->json([
            'message' => 'Migration Success',
            'output'  => Artisan::output()
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});


// ============================================================
// PROTECTED ROUTES (Harus bawa token)
// ============================================================

Route::middleware('auth:sanctum')->group(function () {

    // --- User ---
    Route::get('/user', fn(Request $request) => $request->user());

    Route::put('/user/profile', [AuthController::class, 'updateProfile']);
    Route::post('/user/qris',   [AuthController::class, 'updateQris']);
    Route::post('/logout',      [AuthController::class, 'logout']);

    // --- User Management ---
    Route::get('/users',         [AuthController::class, 'getAllUsers']);
    Route::get('/users/search',  [AuthController::class, 'getUserByEmail']);
    Route::get('/users/{id}',    [AuthController::class, 'getUserById']);

    // --- Products (CRUD butuh login) ---
    Route::post('/products',        [ProductController::class, 'store']);
    Route::put('/products/{id}',    [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);

    // --- Cart ---
    Route::post('/carts', [CartController::class, 'addToCart']);
    Route::get('/carts',  [CartController::class, 'getMyCart']);

    // --- Orders (Konsumen) ---
    Route::post('/orders',           [OrderController::class, 'store']);
    Route::get('/orders/history',    [OrderController::class, 'index']);
    Route::get('/orders/user/{id}',  [OrderController::class, 'getByUserId']);

    // --- Orders (Pedagang) ---
    Route::get('/merchant/orders',         [OrderController::class, 'merchantIndex']);
    Route::get('/orders/merchant/{id}',    [OrderController::class, 'getByMerchantId']);
    Route::patch('/orders/{id}/status',    [OrderController::class, 'updateStatus']);

    // --- Purchases & Expenses ---
    Route::apiResource('purchases', PurchaseController::class);
    Route::apiResource('expenses',  MonthlyExpenseController::class);

});