<?php

namespace Via\LaravelSovren;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class SovrenServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/sovren.php' => config_path('laravel-sovren.php'),
            ], 'config');
        }

        $this->publishes([
            __DIR__.'/../config/sovren.php' => config_path('sovren.php'),
        ], 'config');
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/sovren.php', 'sovren');

        // Register the main class to use with the facade
        $this->app->singleton('laravel-sovren', static function () {
            $client = new Client([
                'base_uri' => config('sovren.sovren-base-uri'),
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Sovren-AccountId' => config('sovren.sovren-accountid'),
                    'Sovren-ServiceKey' => config('sovren.sovren-servicekey'),
                ]
            ]);
            return new Sovren($client);
        });
    }
}
