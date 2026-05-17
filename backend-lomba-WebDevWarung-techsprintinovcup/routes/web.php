<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.register');
});

Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/dashboard/seller', function () {
    return view('dashboard.dashboard_seller');
});

Route::get('/dashboard/consument', function () {
    return view('dashboard.dashboard_consument');
});
Route::get('/menu/create', function () {
    return view('products.katalog_menu'); 
});

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
});

Route::get('/detail-pesanan', function () {
    return view('order.detail_pesanan');
});

Route::get('/halaman-pembayaran', function () {
    return view('order.halaman_pembayaran');
});

Route::get('/history-pemesan', function () {
    return view('order.history_pemesan');
});

Route::get('/status-pesanan', function () {
    return view('order.status_pesanan');
});

Route::get('/pesanan-sukses', function () {
    return view('order.pesanan_sukses');
});

Route::get('/halaman-labarugi', function () {
    return view('order.halaman_labarugi');
});

Route::get('/history-penjual', function () {
    return view('order.history_penjual');
});

Route::get('/debug-data', function() {
    return [
        'total_users' => \App\Models\User::count(),
        'roles_in_db' => \App\Models\Role::all(), // Cek apakah role sudah masuk
        'categories' => \App\Models\Category::all(),
    ];
});
