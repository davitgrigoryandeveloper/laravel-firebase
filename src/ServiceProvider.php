<?php

namespace Esterox\LaravelFirebaseSendNotification;

use Illuminate\Support\Facades\Config;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/firebase.php' => $this->app->configPath('firebase.php'),
        ], 'config');
    }
}
