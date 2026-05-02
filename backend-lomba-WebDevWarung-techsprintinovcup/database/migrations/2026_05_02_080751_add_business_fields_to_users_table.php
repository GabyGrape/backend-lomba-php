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
        $table->string('nama_warung')->nullable()->after('role');
        $table->text('alamat_warung')->nullable()->after('nama_warung');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users_', function (Blueprint $table) {
            //
        });
    }
};
