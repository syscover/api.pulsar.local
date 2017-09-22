<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Syscover\Crm\GraphQL\CrmGraphQLServiceProvider;

class UpsServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		// load autoload from package composer.json
		require $this->app->basePath() . '/workbench/syscover/pulsar-ups/vendor/autoload.php';

        // register routes
        $this->loadRoutesFrom($this->app->basePath() . '/workbench/syscover/pulsar-ups/src/routes/api.php');

        // register config files
        $this->publishes([
            $this->app->basePath() . '/workbench/syscover/pulsar-crm/src/config/pulsar-crm.php' => config_path('pulsar-ups.php'),
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