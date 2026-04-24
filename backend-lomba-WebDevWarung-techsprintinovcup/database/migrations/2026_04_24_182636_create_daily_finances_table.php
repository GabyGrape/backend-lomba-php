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
        Schema::create('daily_finances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(); // Owner/Pedagang
            $table->date('date'); // Tanggal catatan
            $table->decimal('modal_harian', 15, 2)->default(0);
            $table->decimal('pendapatan_kotor', 15, 2)->default(0); // Ini nanti otomasi dari sum order harian
            $table->decimal('laba_rugi', 15, 2)->default(0); // Hasil: Pendapatan - Modal
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_finances');
    }
};
