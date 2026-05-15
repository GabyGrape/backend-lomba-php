<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Purchase extends Model
{
    //
    protected $table = 'purchases';
    protected $fillable = [
    'user_id', 'effective_date', 'product_name', 'product_description',
    'quantity', 'unit_price', 'total_purchase_price', 'remaining_stock',
    'used_stock', 'sold_quantity', 'selling_price', 'total_sold_price'
];

public function user()
    {
        // Beritahu Laravel secara eksplisit untuk mencari ke model User (yang tabelnya users_)
        return $this->belongsTo(User::class, 'user_id');
    }
}
