<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Migration: Create Inventory Stocks
Schema::create('inventory_stocks', function (Blueprint $table) {
    $table->id();
    $table->foreignId('merchant_id')->constrained('users_')->onDelete('cascade');
    $table->string('product_name'); // Atau product_id jika sudah konsisten
    $table->double('total_quantity')->default(0);
    $table->double('average_unit_price')->default(0); // Nilai rata-rata (COGS)
    $table->double('total_inventory_value')->default(0); // qty * avg_price
    $table->timestamps();
    
    $table->unique(['merchant_id', 'product_name']); 
});

// Migration: Create Daily Financial Reports
Schema::create('daily_financial_reports', function (Blueprint $table) {
    $table->id();
    $table->foreignId('merchant_id')->constrained('users_')->onDelete('cascade');
    $table->date('report_date');
    $table->decimal('total_purchases', 15, 2)->default(0); // Pengeluaran beli stok
    $table->decimal('total_sales', 15, 2)->default(0);     // Omzet (Gross Revenue)
    $table->decimal('total_cogs', 15, 2)->default(0);      // HPP (Modal barang yang terjual)
    $table->decimal('gross_profit', 15, 2)->default(0);    // Sales - COGS
    $table->decimal('monthly_expenses', 15, 2)->default(0); // Beban bulanan (listrik, dll) proporsional
    $table->decimal('net_profit', 15, 2)->default(0);      // gross_profit - expenses
    $table->timestamps();

    $table->unique(['merchant_id', 'report_date']);
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_financial_reports');
        Schema::dropIfExists('inventory_stocks');
    }
};
