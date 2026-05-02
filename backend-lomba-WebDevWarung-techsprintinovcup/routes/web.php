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

