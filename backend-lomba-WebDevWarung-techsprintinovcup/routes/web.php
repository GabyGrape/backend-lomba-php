<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
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
Route::get('/debug-data', function() {
    return [
        'users' => \App\Models\User::all(),
        'total' => \App\Models\User::count(),
        'database_path' => config('database.connections.sqlite.database'),
    ];
});
