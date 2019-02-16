<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Syscover\Admin\GraphQL\AdminGraphQLServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		// load autoload from package composer.json
		require $this->app->basePath() . '/workbench/syscover/pulsar-admin/vendor/autoload.php';

        // register routes
        $this->loadRoutesFrom($this->app->basePath() . '/workbench/syscover/pulsar-admin/src/routes/api.php');

        // register migrations
        $this->loadMigrationsFrom($this->app->basePath() . '/workbench/syscover/pulsar-admin/src/database/migrations');

        // register seeds
        $this->publishes([
            $this->app->basePath() . '/workbench/syscover/pulsar-admin/src/database/seeds/' => base_path('/database/seeds')
        ], 'seeds');

        // register translations
        $this->loadTranslationsFrom($this->app->basePath() . '/workbench/syscover/pulsar-admin/src/resources/lang', 'admin');

        // register config files
        $this->publishes([
            $this->app->basePath() . '/workbench/syscover/pulsar-admin/src/config/pulsar-admin.php' => config_path('pulsar-admin.php'),
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