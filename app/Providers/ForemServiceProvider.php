<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ForemServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		// load autoload from package composer.json
		require $this->app->basePath() . '/workbench/syscover/pulsar-forem/vendor/autoload.php';

        // register migrations
        $this->loadMigrationsFrom($this->app->basePath() . '/workbench/syscover/pulsar-forem/src/database/migrations');

        // register seeds
        $this->publishes([
            $this->app->basePath() . '/workbench/syscover/pulsar-forem/src/database/seeds/' => base_path('/database/seeds')
        ], 'seeds');

        // register config files
        $this->publishes([
            $this->app->basePath() . '/workbench/syscover/pulsar-forem/src/config/pulsar-forem.php' => config_path('pulsar-forem.php'),
        ]);
    }

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
	}
}