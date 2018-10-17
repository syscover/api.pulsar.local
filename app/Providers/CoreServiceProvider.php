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

        // register views
        $this->loadViewsFrom($this->app->basePath() . '/workbench/syscover/pulsar-core/src/resources/views', 'core');

        // register config files
        $this->publishes([
            $this->app->basePath() . '/workbench/syscover/pulsar-core/src/config/pulsar-core.php' => config_path('pulsar-core.php')
        ]);

        // register translations
        $this->loadTranslationsFrom($this->app->basePath() . '/workbench/syscover/pulsar-core/src/resources/lang', 'core');
    }

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register() { }
}