<?php

namespace Esterox\FirebaseSendNotification;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class FirebaseServiceProvider extends ServiceProvider
{

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/firebase.php' => config_path('firebase.php'),
        ], 'config');

        $this->mergeConfigFrom(
            __DIR__ . '/../config/firebase.php', 'firebase'
        );
    }

    public function register()
    {
        // Register services, facades, and other package components
    }
}
