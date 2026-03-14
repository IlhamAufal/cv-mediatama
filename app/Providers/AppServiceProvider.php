<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
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
        // Cegah lazy loading (N+1) di environment non-production
        // Akan throw exception jika ada relasi yang tidak di-eager load
        Model::preventLazyLoading(! app()->isProduction());

        // Batasi jumlah query per request di development (opsional, ubah angkanya)
        // Model::preventSilentlyDiscardingAttributes(! app()->isProduction());
    }
}
