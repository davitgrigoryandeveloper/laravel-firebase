<?php

namespace Esterox\FirebaseSendNotification\Services;

class FirebaseHttpClient
{
    public function sendRequest(string $url, array $headers, array $data): string
    {
        // Initialize curl resource
        $ch = curl_init();

        // Set curl options
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => json_encode($data),
        ]);

        // Execute the request
        $response = curl_exec($ch);

        // Check for curl errors
        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
            error_log("cURL Error: $error_msg");
            curl_close($ch);
            return false;
        }

        curl_close($ch);

        return $response;
    }
}
