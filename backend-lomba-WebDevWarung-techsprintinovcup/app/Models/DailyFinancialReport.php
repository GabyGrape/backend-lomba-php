<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyFinancialReport extends Model
{
    //
    protected $fillable = [
        'merchant_id',
        'report_date',
        'total_purchases',
        'total_sales',
        'total_cogs',
        'gross_profit',
        'monthly_expenses',
        'net_profit'
    ];
}
