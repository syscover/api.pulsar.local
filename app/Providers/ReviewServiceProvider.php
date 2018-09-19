<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;
use Syscover\Review\GraphQL\ReviewGraphQLServiceProvider;
use Syscover\Review\Services\CronService;

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
        $this->loadRoutesFrom($this->app->basePath() . '/workbench/syscover/pulsar-review/src/routes/web.php');

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

        // call code after boot application
        $this->app->booted(function () {
            // declare schedule
            $schedule = app(Schedule::class);

            // send new reviews
            $schedule->call(function () {
                CronService::checkMailingReview();
            })->everyMinute();

            // delete reviews expired
            $schedule->call(function () {
                CronService::checkDeleteReview();
            })->daily();
        });
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