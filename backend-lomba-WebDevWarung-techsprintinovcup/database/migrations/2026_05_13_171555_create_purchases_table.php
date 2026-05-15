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
        Schema::create('purchases', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained('users_')->onDelete('cascade');
    $table->timestamp('effective_date')->nullable(); // Tanggal efektif
    $table->string('product_name');
    $table->text('product_description')->nullable();
    $table->double('quantity');
    $table->double('unit_price');
    $table->double('total_purchase_price'); // quantity * unit_price
    $table->double('remaining_stock')->default(0);
    $table->double('used_stock')->default(0); // quantity - remaining_stock
    $table->double('sold_quantity')->default(0);
    $table->double('selling_price')->default(0);
    $table->double('total_sold_price')->default(0); // sold_quantity * selling_price
    $table->timestamps(); // created_at & updated_at
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
