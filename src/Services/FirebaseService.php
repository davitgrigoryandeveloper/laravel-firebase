<?php

namespace Esterox\Firebase\Services;

use Esterox\Firebase\Contracts\FirebaseServiceInterface;

class FirebaseService implements FirebaseServiceInterface
{
    protected FirebaseHttpClient $httpClient;

    public function __construct(FirebaseHttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function send(array $data, array $firebaseTokens): bool
    {
        if (!isset($data['registration_ids']) && !isset($data['to'])) {
            $data['registration_ids'] = $firebaseTokens;
        }

        $headers = [
            'Authorization: key=' . $this->getFirebaseServerKey(),
            'Content-Type: application/json',
        ];

        // Send request
        $url = 'https://fcm.googleapis.com/fcm/send';
        $response = $this->httpClient->sendRequest($url, $headers, $data);

        // Ensure error handling
        return $response !== false;
    }

    protected function getFirebaseServerKey(): string
    {
        return config('firebase.firebase_server_key');
    }
}
