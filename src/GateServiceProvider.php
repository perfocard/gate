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
            $urls = $this->normalizeProxyUrls(config('gate.urls', ''));

            if (count($urls) === 0) {
                throw new GateNotConfigured;
            }

            $proxyUrl = $urls[array_rand($urls)];

            Http::globalOptions([
                'proxy' => $proxyUrl,
            ]);
        }
    }

    /**
     * Normalize proxy URLs from config value (comma-separated string or array).
     *
     * @return array<int, string>
     */
    private function normalizeProxyUrls(mixed $urls): array
    {
        if (is_string($urls)) {
            $urls = array_map('trim', explode(',', $urls));
        }
        if (! is_array($urls)) {
            $urls = [$urls];
        }

        return array_values(array_filter($urls, static function ($u): bool {
            return is_string($u) && $u !== '';
        }));
    }
}
