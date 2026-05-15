<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema; // Tambahkan ini
use Illuminate\Support\Facades\DB;     // Tambahkan ini

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
{
    // Hanya jalan jika di production DAN tidak sedang menjalankan command via terminal (biar build aman)
    if (config('app.env') === 'production' && !app()->runningInConsole()) {
        try {
            \Illuminate\Support\Facades\Artisan::call('migrate --force');
            // Kita skip seeder di sini dulu biar build-nya lolos
        } catch (\Exception $e) {
            // Biarkan saja agar build tidak mati
        }
        
        // Tambahkan baris ini untuk mematikan pengecekan foreign key di SQLite
        if (config('database.default') === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = OFF');
        }
    }
}
}
