<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// 1. Memanggil Model agar bisa digunakan di bawah
use App\Models\Role; 
use App\Models\Category; 
use App\Models\OrderStatus; 

class DatabaseWarungSeeder extends Seeder
{
    public function run(): void
    {
        // 2. Isi Roles
        // Karena sudah ada 'use App\Models\Role' di atas, cukup tulis Role::
        Role::create([
            'name' => 'pedagang', 
            'display_name' => 'Pemilik Warung'
        ]);

        Role::create([
            'name' => 'konsumen', 
            'display_name' => 'Pembeli/Pelanggan'
        ]);

        // 3. Isi Kategori
        Category::create([
            'name' => 'Makanan', 
            'slug' => 'makanan'
        ]);

        Category::create([
            'name' => 'Minuman', 
            'slug' => 'minuman'
        ]);

        // 4. Isi Status Pesanan
        OrderStatus::create([
            'name' => 'pending', 
            'label' => 'Menunggu Konfirmasi', 
            'color' => '#FFA500'
        ]);

        OrderStatus::create([
            'name' => 'processing', 
            'label' => 'Sedang Dimasak', 
            'color' => '#0000FF'
        ]);

        OrderStatus::create([
            'name' => 'completed', 
            'label' => 'Selesai', 
            'color' => '#008000'
        ]);
    }
}