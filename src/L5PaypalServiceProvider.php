<?php

namespace XSTech\L5Paypal;

use Illuminate\Support\ServiceProvider;

class L5PaypalServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('l5paypal', function ($app) {
            return new Paypal();
        });

        $this->publishes([
            __DIR__ . '/../../config/paypal.php' => config_path('paypal.php')
        ]);
    }

    public function provides()
    {
        return [
            'paypal'
        ];
    }
}
