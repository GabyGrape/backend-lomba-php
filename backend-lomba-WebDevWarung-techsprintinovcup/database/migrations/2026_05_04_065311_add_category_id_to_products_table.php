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
    Schema::table('products_', function (Blueprint $table) {
        // Hapus kolom lama
        $table->dropColumn('kategori'); 
        // Tambah foreign key ke tabel categories
        $table->foreignId('category_id')->nullable>constrained('categories')->onDelete('set null');
    });
}

public function down(): void
{
    Schema::table('products_', function (Blueprint $table) {
        $table->dropForeign(['category_id']);
        $table->dropColumn('category_id');
        $table->string('kategori')->nullable(); // Balikin kolom lama kalau mau rollback
    });
}
};
