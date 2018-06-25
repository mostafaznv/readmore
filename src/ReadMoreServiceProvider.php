<?php

namespace Mostafaznv\ReadMore;

use Illuminate\Support\ServiceProvider;

class ReadMoreServiceProvider extends ServiceProvider
{
    const VERSION = '0.0.1';

    public function boot()
    {
        if ($this->app->runningInConsole())
            $this->publishes([__DIR__ . '/../config/config.php' => config_path('read-more.php')], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'read-more');

        $this->app->bind('read-more', function() {
            return new ReadMore();
        });
    }
}