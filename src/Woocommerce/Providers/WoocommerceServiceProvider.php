<?php

namespace C14r\Woocommerce\Providers;

use C14r\Woocommerce\V3\API;
use Illuminate\Support\ServiceProvider;

class WoocommerceServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/woocommerce.php' => config_path('woocommerce.php'),
        ], 'woocommerce-config');
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../../config/woocommerce.php', 'woocommerce'
        );

        $this->app->singleton('woo', function ($app, $connection = null) {
            return API::getInstance($connection);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [API::class];
    }
}