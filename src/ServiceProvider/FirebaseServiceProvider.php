<?php

namespace Esterox\Firebase\ServiceProvider;

use Illuminate\Support\ServiceProvider;
use Esterox\Firebase\Contracts\HttpClientInterface;
use Esterox\Firebase\Utils\HttpClient;
use Esterox\Firebase\Contracts\FirebaseServiceInterface;
use Esterox\Firebase\Services\FirebaseService;

class FirebaseServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected bool $defer = true;

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Publish the configuration file
        if ($this->app->environment('local')) {
            $this->publishes([
                __DIR__ . '/../../config/firebase.php' => config_path('firebase.php'),
            ], 'config');
        }

        // Merge the package configuration with the application's configuration
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/firebase.php', 'firebase'
        );
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind HttpClientInterface to the implementation HttpClient
        $this->app->bind(HttpClientInterface::class, HttpClient::class);

        // Bind FirebaseServiceInterface to the implementation FirebaseService
        $this->app->bind(FirebaseServiceInterface::class, function ($app) {
            $httpClient = $app->make(HttpClientInterface::class);
            return new FirebaseService($httpClient);
        });

        // Alias FirebaseServiceInterface for easier use
        $this->app->alias(FirebaseServiceInterface::class, 'firebase-notification');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        // Return the list of services provided by this provider.
        // This helps Laravel understand what this provider is responsible for when it's deferred.
        return [FirebaseServiceInterface::class, HttpClientInterface::class];
    }
}
