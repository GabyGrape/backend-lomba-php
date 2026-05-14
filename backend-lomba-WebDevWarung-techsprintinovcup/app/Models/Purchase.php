<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Purchase extends Model
{
    //
    protected $fillable = [
    'user_id', 'effective_date', 'product_name', 'product_description',
    'quantity', 'unit_price', 'total_purchase_price', 'remaining_stock',
    'used_stock', 'sold_quantity', 'selling_price', 'total_sold_price'
];

public function user() {
    return $this->belongsTo(User::class);
}
}
