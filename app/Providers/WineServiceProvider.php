<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Syscover\Crm\GraphQL\CrmGraphQLServiceProvider;

class WineServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		// load autoload from package composer.json
		require $this->app->basePath() . '/workbench/syscover/pulsar-wine/vendor/autoload.php';

        // register migrations
        $this->loadMigrationsFrom($this->app->basePath() . '/workbench/syscover/pulsar-wine/src/database/migrations');

        // register seeds
        $this->publishes([
            $this->app->basePath() . '/workbench/syscover/pulsar-wine/src/database/seeds/' => base_path('/database/seeds')
        ], 'seeds');

        // register config files
        $this->publishes([
            $this->app->basePath() . '/workbench/syscover/pulsar-wine/src/config/pulsar-wine.php' => config_path('pulsar-wine.php'),
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