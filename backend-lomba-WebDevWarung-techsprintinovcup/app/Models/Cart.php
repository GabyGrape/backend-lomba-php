<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts_'; // Pastikan nama tabel benar

    protected $fillable = [
        'user_id',
        'product_id',
        'pedagang_id',
        'qty',
        'price'
    ];

    // Relasi ke Produk agar bisa ambil nama_menu saat get keranjang
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}