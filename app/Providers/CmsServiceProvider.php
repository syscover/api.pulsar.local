<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CmsServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		// load autoload from package composer.json
		require $this->app->basePath() . '/workbench/syscover/pulsar-cms/vendor/autoload.php';

        // register routes
        $this->loadRoutesFrom($this->app->basePath() . '/workbench/syscover/pulsar-cms/src/routes/api.php');

        // register migrations
        $this->loadMigrationsFrom($this->app->basePath() . '/workbench/syscover/pulsar-cms/src/database/migrations');

        // register translations
        $this->loadTranslationsFrom($this->app->basePath() . '/workbench/syscover/pulsar-cms/src/resources/lang', 'cms');

        // register seeds
        $this->publishes([
            $this->app->basePath() . '/workbench/syscover/pulsar-cms/src/database/seeds/' => base_path('/database/seeds')
        ], 'seeds');

        // register tests
//        $this->publishes([
//            $this->app->basePath() . '/workbench/syscover/pulsar-cms/src/tests/Feature/' => base_path('/tests/Feature')
//        ], 'tests');

        // register config files
        $this->publishes([
            $this->app->basePath() . '/workbench/syscover/pulsar-cms/src/config/pulsar-cms.php' => config_path('pulsar-cms.php'),
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
