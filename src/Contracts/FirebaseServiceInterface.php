<?php

namespace Esterox\Firebase\Contracts;

interface FirebaseServiceInterface
{
    public function send(array $data, array $firebaseTokens): bool;
}
