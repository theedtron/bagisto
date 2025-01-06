<?php

namespace Webkul\MPesa\Providers;

use Illuminate\Support\ServiceProvider;

class MPesaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'mpesa');

        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'mpesa');

        $this->loadRoutesFrom(__DIR__ . '/../Http/routes.php');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfig();
    }

    /**
     * Register package config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        // $this->publishes([
        //     dirname(__DIR__) . '/Config/paymentmethods.php' => config_path('paymentmethods.php'),
        //     dirname(__DIR__) . '/Config/mpesa.php' => config_path('mpesa.php'),
        //     dirname(__DIR__) . '/Config/system.php' => config_path('system.php'),
        // ]);

        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/paymentmethods.php', 'payment_methods'
        );

        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/system.php', 'core'
        );

        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/mpesa.php', 'mpesa'
        );
    }
}