<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class UpdateServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		// load autoload from package composer.json
		require $this->app->basePath() . '/workbench/syscover/pulsar-update/vendor/autoload.php';

        // register routes
        $this->loadRoutesFrom($this->app->basePath() . '/workbench/syscover/pulsar-update/src/routes/api.php');

        // register migrations
        $this->loadMigrationsFrom($this->app->basePath() . '/workbench/syscover/pulsar-update/src/database/migrations');

        // register seeds
        $this->publishes([
            $this->app->basePath() . '/workbench/syscover/pulsar-update/src/database/seeds/' => base_path('/database/seeds')
        ], 'seeds');

        // register config files
        $this->publishes([
            $this->app->basePath() . '/workbench/syscover/pulsar-update/src/config/pulsar-update.php' => config_path('pulsar-update.php'),
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
