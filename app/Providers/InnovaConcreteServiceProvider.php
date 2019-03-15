<?php namespace App\Providers;;

use Illuminate\Support\ServiceProvider;

class InnovaConcreteServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
        // load autoload from package composer.json
        require $this->app->basePath() . '/workbench/techedge/pulsar-innova-concrete/vendor/autoload.php';

        // register routes
        $this->loadRoutesFrom($this->app->basePath() . '/workbench/techedge/pulsar-innova-concrete/src/routes/api.php');

        // register migrations
        $this->loadMigrationsFrom($this->app->basePath() . '/workbench/techedge/pulsar-innova-concrete/src/database/migrations');

        // register seeds
        $this->publishes([
            $this->app->basePath() . '/workbench/techedge/pulsar-innova-concrete/src/database/seeds/' => base_path('/database/seeds')
        ], 'seeds');

        // register config files
        $this->publishes([
            $this->app->basePath() . '/workbench/techedge/pulsar-innova-concrete/src/config/pulsar-innova-concrete.php' => config_path('pulsar-innova-concrete.php'),
        ]);
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
        //
	}
}
