<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// Import class URL
use Illuminate\Support\Facades\URL; 

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Solusi Keras: Memaksa skema URL menjadi HTTPS
        // Lakukan ini HANYA jika APP_ENV bukan 'local' (yaitu, di lingkungan produksi/staging)
        if ($this->app->environment('production', 'staging')) {
            // Atau, Anda bisa menggunakan kondisi yang lebih sederhana:
            // if (config('app.env') !== 'local') {
                
            // Baris KRITIS: Memaksa semua URL yang dihasilkan menggunakan HTTPS
            URL::forceScheme('https');
        }
    }
}