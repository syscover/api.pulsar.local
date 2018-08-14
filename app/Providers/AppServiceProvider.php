<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
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

//        \Illuminate\Support\Facades\DB::listen(function ($query) {
//            \Illuminate\Support\Facades\Log::info($query->sql);
//        });
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
