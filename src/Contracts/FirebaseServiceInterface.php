<?php

namespace Esterox\Firebase\Contracts;

interface FirebaseServiceInterface
{
    public function sendNotification(array $data, array $firebaseTokens): bool;
}
