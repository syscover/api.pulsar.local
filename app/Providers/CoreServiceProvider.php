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

        // register views
        $this->loadViewsFrom($this->app->basePath() . '/workbench/syscover/pulsar-core/src/views', 'core');

        // register config files
        $this->publishes([
            $this->app->basePath() . '/workbench/syscover/pulsar-core/src/config/pulsar-core.php' => config_path('pulsar-core.php'),
            $this->app->basePath() . '/workbench/syscover/pulsar-core/src/public'                 => public_path('/vendor/pulsar-core')
        ]);

        // register translations
        $this->loadTranslationsFrom($this->app->basePath() . '/workbench/syscover/pulsar-core/src/lang', 'core');

        // register GraphQL types and schema
        CoreGraphQLServiceProvider::bootGraphQLTypes();
        CoreGraphQLServiceProvider::bootGraphQLSchema();
    }

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register() { }
}