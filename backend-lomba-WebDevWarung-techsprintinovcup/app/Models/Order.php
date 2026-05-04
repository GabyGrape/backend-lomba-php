<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    // Tambahkan user_id ke dalam array ini
    protected $fillable = [
        'user_id',
        'total_price',
        'status_id',
        'merchant_id',
        'pickup_plan_at',
        // tambahkan kolom lain yang ingin kamu izinkan untuk mass assignment
    ];
    //
    public function items()
{
    return $this->hasMany(OrderItem::class);
}

public function customer()
{
    return $this->belongsTo(User::class, 'user_id');
}

public function merchant()
{
    return $this->belongsTo(User::class, 'merchant_id');
}
}
