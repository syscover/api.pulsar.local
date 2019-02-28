<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BcciServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		// load autoload from package composer.json
		require $this->app->basePath() . '/workbench/techedge/pulsar-bcci/vendor/autoload.php';

        // register routes
        // $this->loadRoutesFrom($this->app->basePath() . '/workbench/techedge/pulsar-bcci/src/routes/api.php');

        // register migrations
        $this->loadMigrationsFrom($this->app->basePath() . '/workbench/techedge/pulsar-bcci/src/database/migrations');

        // register translations
        // $this->loadTranslationsFrom($this->app->basePath() . '/workbench/techedge/pulsar-bcci/src/resources/lang', 'bcci');

        // register seeds
        $this->publishes([
            $this->app->basePath() . '/workbench/techedge/pulsar-bcci/src/database/seeds/' => base_path('/database/seeds')
        ], 'seeds');

        // register tests
//        $this->publishes([
//            $this->app->basePath() . '/workbench/techedge/pulsar-bcci/src/tests/Feature/' => base_path('/tests/Feature')
//        ], 'tests');

        // register config files
        $this->publishes([
            $this->app->basePath() . '/workbench/techedge/pulsar-bcci/src/config/pulsar-bcci.php' => config_path('pulsar-bcci.php'),
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
