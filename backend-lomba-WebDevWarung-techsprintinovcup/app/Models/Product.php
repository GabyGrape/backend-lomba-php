<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Nama tabel di database
    protected $table = 'products_'; 

    // Kolom yang boleh diisi (sesuai list yang kamu kasih tadi)
    protected $fillable = [
        'nama_menu', 
        'deskripsi', 
        'harga', 
        'gambar', 
        'user_id', 
        'status', 
        'stok', 
        'category_id'
    ];
}
