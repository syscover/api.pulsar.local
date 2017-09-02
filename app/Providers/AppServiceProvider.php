<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Syscover\Core\GraphQL\ScalarTypes\ObjectType;
use Syscover\Core\GraphQL\ScalarTypes\AnyType;

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
        //
        $this->app->singleton(ObjectType::class, function ($app) {
            return new ObjectType();
        });

        $this->app->singleton(AnyType::class, function ($app) {
            return new AnyType();
        });
    }
}
