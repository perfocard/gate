<?php

namespace Perfocard\Gate;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;
use Perfocard\Gate\Exceptions\GateNotConfigured;

class GateServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/gate.php', 'gate');
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/gate.php' => config_path('gate.php'),
            ], 'config');
        }

        if (config('gate.enabled')) {
            if (is_null(config('gate.url'))) {
                throw new GateNotConfigured;
            }

            Http::globalOptions([
                'proxy' => config('gate.url'),
            ]);
        }
    }
}
