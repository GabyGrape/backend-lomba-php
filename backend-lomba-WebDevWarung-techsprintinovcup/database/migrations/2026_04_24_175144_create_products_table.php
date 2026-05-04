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
        Schema::create('products_', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nama_menu');
            $table->text('deskripsi');
            $table->decimal('harga', 10, 2);
            $table->string('gambar')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users_')->onDelete('cascade');
            $table->enum('status', ['tersedia', 'habis'])->default('tersedia');
            $table->integer('stok')->default(0);
            $table->string('kategori')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_');
    }
};
