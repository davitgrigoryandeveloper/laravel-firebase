<?php

namespace Esterox\FirebaseSendNotification\Services;

use Esterox\FirebaseSendNotification\Contracts\FirebaseServiceInterface;
use Esterox\FirebaseSendNotification\Services\FirebaseHttpClient;

class FirebaseService implements FirebaseServiceInterface
{
    protected $httpClient;

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
            'Authorization: key=' . config('firebase.firebase_server_key'),
            'Content-Type: application/json',
        ];

        $url = 'https://fcm.googleapis.com/fcm/send';
        $response = $this->httpClient->sendRequest($url, $headers, $data);

        return $response !== false;
    }
}
