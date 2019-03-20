<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Syscover\Market\GraphQL\MarketGraphQLServiceProvider;

class MarketServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		// load autoload from package composer.json
		require $this->app->basePath() . '/workbench/syscover/pulsar-market/vendor/autoload.php';

        // register routes
        $this->loadRoutesFrom($this->app->basePath() . '/workbench/syscover/pulsar-market/src/routes/api.php');
        $this->loadRoutesFrom($this->app->basePath() . '/workbench/syscover/pulsar-market/src/routes/web.php');

        // register migrations
        $this->loadMigrationsFrom($this->app->basePath() . '/workbench/syscover/pulsar-market/src/database/migrations');

        // register translations
        $this->loadTranslationsFrom($this->app->basePath() . '/workbench/syscover/pulsar-market/src/resources/lang', 'market');

        // register seeds
        $this->publishes([
            $this->app->basePath() . '/workbench/syscover/pulsar-market/src/database/seeds/' => base_path('/database/seeds')
        ], 'seeds');

        // register config files
        $this->publishes([
            $this->app->basePath() . '/workbench/syscover/pulsar-market/src/config/pulsar-market.php' => config_path('pulsar-market.php'),
        ]);

        // register tests
        $this->publishes([
            $this->app->basePath() . '/workbench/syscover/pulsar-market/src/tests/Feature' => base_path('/tests/Feature'),
        ], 'tests');
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
