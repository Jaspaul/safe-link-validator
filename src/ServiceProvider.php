<?php

namespace Jaspaul\SafeLinkValidator;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class ServiceProvider extends IlluminateServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishConfigurations();
        $this->loadTranslationsFrom(__DIR__ . '/../resources/translations', 'safe-links');
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../resources/config/safe-links.php', 'safe-links');
    }

    /**
     * Adds our configuration file to the publishes array.
     *
     * @return void
     */
    protected function publishConfigurations()
    {
        $this->publishes([
            __DIR__ . '/../resources/config/safe-links.php' => config_path('safe-links.php'),
        ]);

        $this->publishes([
            __DIR__ . '/../resources/translations' => resource_path('lang/vendor/safe-links'),
        ]);
    }
}
