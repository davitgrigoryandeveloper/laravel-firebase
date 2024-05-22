<?php

namespace Esterox\Firebase\ServiceProvider;

use Illuminate\Support\ServiceProvider;
use Esterox\Firebase\Contracts\HttpClientInterface;
use Esterox\Firebase\Utils\HttpClient;
use Esterox\Firebase\Contracts\FirebaseServiceInterface;
use Esterox\Firebase\Services\FirebaseService;

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
        // Bind HttpClientInterface to HttpClient
        $this->app->bind(HttpClientInterface::class, HttpClient::class);

        // Bind FirebaseService
        $this->app->bind(FirebaseServiceInterface::class, function ($app) {
            $httpClient = $app->make(HttpClientInterface::class);
            return new FirebaseService($httpClient);
        });

        // Alias for FirebaseServiceInterface
        $this->app->alias(FirebaseServiceInterface::class, 'firebase-notification');
    }
}
