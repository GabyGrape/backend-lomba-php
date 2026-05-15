<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryStock extends Model
{
    //
    protected $fillable = [
        'merchant_id',
        'product_name',
        'total_quantity',
        'average_unit_price',
        'total_inventory_value'
    ];
}
