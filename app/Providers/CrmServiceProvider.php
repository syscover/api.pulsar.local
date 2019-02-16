<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CrmServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		// load autoload from package composer.json
		require $this->app->basePath() . '/workbench/syscover/pulsar-crm/vendor/autoload.php';

        // register routes
        $this->loadRoutesFrom($this->app->basePath() . '/workbench/syscover/pulsar-crm/src/routes/api.php');

        // register migrations
        $this->loadMigrationsFrom($this->app->basePath() . '/workbench/syscover/pulsar-crm/src/database/migrations');

        // register seeds
        $this->publishes([
            $this->app->basePath() . '/workbench/syscover/pulsar-crm/src/database/seeds/' => base_path('/database/seeds')
        ], 'seeds');

        // register config files
        $this->publishes([
            $this->app->basePath() . '/workbench/syscover/pulsar-crm/src/config/pulsar-crm.php' => config_path('pulsar-crm.php'),
        ]);

        // register translations
        $this->loadTranslationsFrom($this->app->basePath() . '/workbench/syscover/pulsar-crm/src/resources/lang', 'crm');
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