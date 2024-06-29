<?php

namespace Esterox\Firebase\Services;

use Esterox\Firebase\Contracts\FirebaseServiceInterface;
use Esterox\Firebase\Contracts\HttpClientInterface;
use Esterox\Firebase\Exceptions\FirebaseException;

class FirebaseService implements FirebaseServiceInterface
{
    protected HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Sends a notification to the given Firebase tokens.
     *
     * @param array $data The notification data to send.
     * @param array $firebaseTokens The Firebase tokens to send the notification to.
     * @return bool True if the notification was sent successfully, false otherwise.
     * @throws FirebaseException if the notification could not be sent.
     */
    public function sendNotification(array $data, array $firebaseTokens): bool
    {
        $headers = $this->buildHeaders();

        // Send request
        $url = 'https://fcm.googleapis.com/fcm/send';
        $response = $this->httpClient->sendRequest($url, $headers, $data);

        // Check response and handle errors
        if ($response === false) {
            throw new FirebaseException('Failed to send notification.');
        }

        return true;
    }

    /**
     * Builds the headers for the Firebase request.
     *
     * @return array The headers for the Firebase request.
     * @throws FirebaseException
     */
    protected function buildHeaders(): array
    {
        return [
            'Authorization: key=' . $this->getFirebaseServerKey(),
            'Content-Type: application/json',
        ];
    }

    /**
     * Retrieves the Firebase server key from the configuration.
     *
     * @return string The Firebase server key.
     * @throws FirebaseException
     */
    protected function getFirebaseServerKey(): string
    {
        $serverKey = config('firebase.firebase_server_key');
        if (!$serverKey) {
            throw new FirebaseException('Firebase server key is not set.');
        }

        return $serverKey;
    }
}
