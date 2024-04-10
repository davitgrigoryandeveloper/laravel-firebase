<?php

namespace Esterox\FirebaseSendNotification\Contracts;

interface FirebaseServiceInterface
{
    public function send(array $data, array $firebaseTokens): bool;
}
