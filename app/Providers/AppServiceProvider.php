<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

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
        // Saat pengembangan: lazy loading yang tak sengaja (N+1) menjadi error, bukan diam-diam lambat
        Model::preventLazyLoading(! $this->app->isProduction());

        // Tombol halaman polos (tanpa Tailwind) agar cocok dengan CSS kita
        Paginator::defaultView('pagination::default');

        // Pendaftaran: paling banyak 5 kiriman per menit dari satu alamat IP
        RateLimiter::for('pendaftaran', fn (Request $request) => Limit::perMinute(5)->by($request->ip()));

        // Cek NIM: dibatasi supaya daftar NIM dan nama tidak mudah disedot lewat skrip
        RateLimiter::for('cek-nim', fn (Request $request) => Limit::perMinute(10)->by($request->ip()));
    }
}