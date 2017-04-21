<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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

        // include route.php file
        if (! $this->app->routesAreCached())
            require $this->app->basePath() . '/workbench/syscover/pulsar-core/src/routes/web.php';

        // publish angular application
        $this->publishes([
            $this->app->basePath() . '/workbench/syscover/pulsar-core/angular' => public_path('/pulsar')
        ]);

        // register config files
        $this->publishes([
            $this->app->basePath() . '/workbench/syscover/pulsar-core/src/config/pulsar.core.php' => config_path('pulsar.core.php'),
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