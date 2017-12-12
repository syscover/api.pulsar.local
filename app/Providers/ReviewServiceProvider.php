<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Syscover\Review\GraphQL\ReviewGraphQLServiceProvider;

class ReviewServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		// load autoload from package composer.json
		require $this->app->basePath() . '/workbench/syscover/pulsar-review/vendor/autoload.php';

        // register routes
        $this->loadRoutesFrom($this->app->basePath() . '/workbench/syscover/pulsar-review/src/routes/api.php');

        // register migrations
        $this->loadMigrationsFrom($this->app->basePath() . '/workbench/syscover/pulsar-review/src/database/migrations');

        // register translations
        $this->loadTranslationsFrom($this->app->basePath() . '/workbench/syscover/pulsar-review/src/lang', 'review');

        // register views
        $this->loadViewsFrom($this->app->basePath() . '/workbench/syscover/pulsar-review/src/views', 'review');

        // register seeds
        $this->publishes([
            $this->app->basePath() . '/workbench/syscover/pulsar-review/src/database/seeds/' => base_path('/database/seeds')
        ], 'seeds');

        // register config files
        $this->publishes([
            $this->app->basePath() . '/workbench/syscover/pulsar-review/src/config/pulsar-review.php' => config_path('pulsar-review.php'),
        ]);

        // register GraphQL types and schema
        ReviewGraphQLServiceProvider::bootGraphQLTypes();
        ReviewGraphQLServiceProvider::bootGraphQLSchema();
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