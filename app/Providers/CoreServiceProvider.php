<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Syscover\Core\GraphQL\CoreGraphQLServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		// load autoload from package composer.json
		require $this->app->basePath() . '/workbench/syscover/pulsar-core/vendor/autoload.php';

        // register routes
        $this->loadRoutesFrom($this->app->basePath() . '/workbench/syscover/pulsar-core/src/routes/api.php');

        // register config files
        $this->publishes([
            $this->app->basePath() . '/workbench/syscover/pulsar-core/src/config/pulsar.core.php' => config_path('pulsar.core.php'),
        ]);

        // register GraphQL types and schema
        CoreGraphQLServiceProvider::bootGraphQLTypes();
        CoreGraphQLServiceProvider::bootGraphQLSchema();
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