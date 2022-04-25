<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

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
        Paginator::useBootstrapFive();

        if (config('app.env') === 'production') {
            \URL::forceScheme('https');
            env('DB_DATABASE', \database_path('devmix.sqlite3'));
        }

        // \URL::forceRootUrl(\Config::get('app.url'));
    }
}