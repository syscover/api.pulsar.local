<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class NavtoolsServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		// load autoload from package composer.json
		require $this->app->basePath() . '/workbench/syscover/pulsar-navtools/vendor/autoload.php';

		// register config files
		$this->publishes([
			$this->app->basePath() . '/workbench/syscover/pulsar-navtools/src/config/pulsar-navtools.php' => config_path('pulsar-navtools.php')
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