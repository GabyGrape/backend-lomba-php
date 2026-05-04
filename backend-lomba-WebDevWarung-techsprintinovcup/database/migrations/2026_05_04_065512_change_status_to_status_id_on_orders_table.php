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
    Schema::table('orders', function (Blueprint $table) {
        $table->dropColumn('status');
        // Tambah foreign key ke tabel order_statuses
        $table->foreignId('status_id')->default(1)->constrained('order_statuses');
    });
}

public function down(): void
{
    Schema::table('orders', function (Blueprint $table) {
        $table->dropForeign(['status_id']);
        $table->dropColumn('status_id');
        $table->string('status')->default('pending');
    });
}
};
