<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Illuminate\Support\Facades\DB::listen(function ($query) {
            // info($query->sql);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
