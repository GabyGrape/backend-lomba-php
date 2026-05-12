<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role; 
use App\Models\Category; 
use App\Models\OrderStatus; 

class DatabaseWarungSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Isi Roles (Pakai updateOrCreate agar tidak error UNIQUE)
        Role::updateOrCreate(
            ['name' => 'pedagang'], 
            ['display_name' => 'Pemilik Warung']
        );

        Role::updateOrCreate(
            ['name' => 'konsumen'], 
            ['display_name' => 'Pembeli/Pelanggan']
        );

        // 2. Isi Kategori
        Category::updateOrCreate(
            ['slug' => 'makanan'], 
            ['name' => 'Makanan']
        );

        Category::updateOrCreate(
            ['slug' => 'minuman'], 
            ['name' => 'Minuman']
        );

        // 3. Isi Status Pesanan
        OrderStatus::updateOrCreate(
            ['name' => 'pending'], 
            ['label' => 'Menunggu Konfirmasi', 'color' => '#FFA500']
        );

        OrderStatus::updateOrCreate(
            ['name' => 'processing'], 
            ['label' => 'Sedang Dimasak', 'color' => '#0000FF']
        );

        OrderStatus::updateOrCreate(
            ['name' => 'completed'], 
            ['label' => 'Selesai', 'color' => '#008000']
        );
    }
}