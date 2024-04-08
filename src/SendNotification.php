<?php

namespace Esterox\LaravelFirebaseSendNotification;

use Illuminate\Support\Facades\Config;

class SendNotification
{

    /**
     * @param array $data
     * @param array $firebaseTokens
     * @return bool
     */
    public function send(array $data, array $firebaseTokens): bool
    {
        if (!isset($data['registration_ids']) && !isset($data['to'])) {
            $data['registration_ids'] = $firebaseTokens;
        }

        $headers = [
            'Authorization: key=' . Config::get('app.firebase_server_key'),
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $res = curl_exec($ch);
        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
        }
        curl_close($ch);

        if (isset($error_msg)) print('error:' . $error_msg);

        return $res !== false;
    }
}
