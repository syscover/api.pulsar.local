<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Syscover\ShoppingCart\CartProvider;

class ShoppingCartServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // load autoload from package composer.json
        require $this->app->basePath() . '/workbench/syscover/pulsar-shopping-cart/vendor/autoload.php';

        // register routes
        $this->loadRoutesFrom($this->app->basePath() . '/workbench/syscover/pulsar-shopping-cart/src/routes/api.php');

        // register tests
        $this->publishes([
                $this->app->basePath() . '/workbench/syscover/pulsar-shopping-cart/src/tests/Feature' => base_path('/tests/Feature')
        ], 'tests');

        // register config files
        $this->publishes([
            $this->app->basePath() . '/workbench/syscover/pulsar-shopping-cart/src/config/pulsar-shopping_cart.php' => config_path('pulsar-shopping_cart.php')
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('cart-provider', CartProvider::class);
    }
}