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
    Schema::create('users_', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        // Disarankan ditambahkan agar tidak error jika pakai fitur Auth Laravel nanti
        $table->timestamp('email_verified_at')->nullable(); 
        $table->string('password');
        $table->enum('role', ['pedagang', 'konsumen', 'user', 'admin', 'developer'])->default('user');
        $table->boolean('is_active')->default(true);
        $table->rememberToken(); // Sangat disarankan untuk fitur login
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_');
    }
};
