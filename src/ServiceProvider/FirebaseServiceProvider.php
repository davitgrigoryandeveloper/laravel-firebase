<?php
// FirebaseServiceProvider.php
namespace Esterox\FirebaseSendNotification\ServiceProvider;

use Illuminate\Support\ServiceProvider;
use Esterox\FirebaseSendNotification\Contracts\FirebaseServiceInterface;
use Esterox\FirebaseSendNotification\Services\FirebaseService;

class FirebaseServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../../config/firebase.php' => config_path('firebase.php'),
        ], 'config');

        $this->mergeConfigFrom(
            __DIR__ . '/../../config/firebase.php', 'firebase'
        );
    }

    public function register()
    {
        $this->app->bind('firebase-notification', function ($app) {
            return new FirebaseService();
        });

        $this->app->alias('firebase-notification', FirebaseServiceInterface::class);
    }
}
