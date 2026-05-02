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
    Schema::table('users_', function (Blueprint $table) {
        // Simpan path file gambar, beri nullable karena konsumen tidak punya QRIS
        $table->string('qris_path')->after('alamat_warung')->nullable();
    });
}

public function down(): void
{
    Schema::table('users_', function (Blueprint $table) {
        $table->dropColumn('qris_path');
    });
}
};
