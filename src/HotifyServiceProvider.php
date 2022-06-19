<?php

namespace Hotify\Hotify;

use Illuminate\Support\ServiceProvider;

class HotifyServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/hotify.php', 'hotify');
    }

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([__DIR__ . '/../config/hotify.php' => config_path('hotify.php')], 'config');
    }
}
