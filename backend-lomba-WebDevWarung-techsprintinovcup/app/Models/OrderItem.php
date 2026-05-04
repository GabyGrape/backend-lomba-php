<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price_at_purchase',
    ];
//
    public function order()
{
    return $this->belongsTo(Order::class);
}

// public function menu()
// {
//     return $this->belongsTo(Menu::class); // Jika nama modelnya Menu
// }
public function product()
    {
        // Karena nama tabelmu unik (products_), pastikan model Product juga merujuk ke tabel tersebut
        return $this->belongsTo(Product::class, 'product_id');
    }
}
