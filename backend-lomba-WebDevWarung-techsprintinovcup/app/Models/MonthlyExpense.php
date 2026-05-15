<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlyExpense extends Model
{
    protected $table = 'monthly_expenses'; // Opsional tapi aman

    protected $fillable = [
        'user_id', 'expense_name', 'unit_price', 
        'quantity', 'total_price', 'expense_date'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}