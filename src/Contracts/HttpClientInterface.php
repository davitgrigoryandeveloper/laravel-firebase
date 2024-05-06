<?php

namespace Esterox\Firebase\Contracts;

interface HttpClientInterface
{
    public function sendRequest(string $url, array $headers, array $data): bool|string;
}