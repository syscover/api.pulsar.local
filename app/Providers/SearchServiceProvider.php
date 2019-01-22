<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Scout\EngineManager;
use Syscover\Search\PulsarSearchEngine;

class SearchServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // load autoload from package composer.json
        require $this->app->basePath() . '/workbench/syscover/pulsar-search/vendor/autoload.php';

        resolve(EngineManager::class)->extend('pulsar-search', function () {
            return new \Syscover\Search\PulsarSearchEngine;
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}