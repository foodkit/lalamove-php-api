<?php

declare(strict_types=1);

namespace Lalamove\Utils;

class SignatureVerifier
{
    protected const HASH_ALGO = 'sha256';

    protected string $algo;

    public function __construct(string $algo = self::HASH_ALGO)
    {
        $this->algo = $algo;
    }

    public function verify(string $uri, array $body, int $requestTime, string $method, string $secretKey, string $signature): bool
    {
        $rawSignature = $this->calculate($uri, $body, $requestTime, $method, $secretKey);

        return $rawSignature === $signature;
    }

    public function calculate(string $uri, array $body, int $requestTime, string $method, string $secretKey): string
    {
        $body = json_encode($body, JSON_UNESCAPED_SLASHES);
        $message = "{$requestTime}\r\n{$method}\r\n{$uri}\r\n\r\n";

        if ($this->isNotGetMethod($method)) {
            $message .= $body;
        }

        return hash_hmac($this->algo, $message, $secretKey);
    }

    private function isNotGetMethod(string $method): bool
    {
        return strtolower($method) !== 'get';
    }
}
