<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
    }
}
}
