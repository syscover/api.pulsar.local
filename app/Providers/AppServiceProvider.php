<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Syscover\Core\GraphQL\Types\ObjectType;
use Syscover\Core\GraphQL\Types\AnyType;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        DB::listen(function ($query) {
            // $query->sql
            // $query->bindings
            // $query->time
            Log::info($query->sql);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ObjectType::class, function ($app) {
            return new ObjectType();
        });

        $this->app->singleton(AnyType::class, function ($app) {
            return new AnyType();
        });
    }
}
