<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Syscover\Ups\Rate;

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
            $this->app->basePath() . '/workbench/syscover/pulsar-ups/src/config/pulsar-ups.php' => config_path('pulsar-ups.php'),
        ]);
    }

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->registerRate();
	}

    /**
     * Register the Rate class.
     *
     * @return void
     */
    protected function registerRate()
    {
        $this->app->singleton('ups.rate', function () {
            return new Rate(
                config('pulsar-ups.user'),
                config('pulsar-ups.password'),
                config('pulsar-ups.access_key')
            );
        });
    }
}