<?php

declare(strict_types=1);

namespace Lalamove\Http;

use Lalamove\Client\V3\Settings as V3Settings;
use Lalamove\Client\V2\Settings as V2Settings;
use Lalamove\Http\Clock\ClockInterface;
use Lalamove\Http\Clock\PslTimeClock;
use Lalamove\Http\Uuid\PslUniqidGenerator;
use Lalamove\Http\Uuid\UuidGeneratorInterface;
use Lalamove\Utils\SignatureVerifier;

class LalamoveRequest
{
    /** @var V2Settings|V3Settings $settings */
    protected $settings;

    protected string $method;

    protected string $uri;

    protected array $params;

    protected ?UuidGeneratorInterface $uuid = null;

    protected ?ClockInterface $clock = null;

    public function __construct(
        $settings,
        $method = 'GET',
        $uri = '',
        $params = [],
        UuidGeneratorInterface $uuid = null,
        ClockInterface $clock = null
    ) {
        $this->settings = $settings;
        $this->method   = $method;
        $this->uri      = $uri;
        $this->params   = $this->object2array($params);

        // Dependency injected for easier unit testing:
        if (is_null($uuid)) {
            $uuid = new PslUniqidGenerator();
        }
        $this->uuid = $uuid;

        if (is_null($clock)) {
            $clock = new PslTimeClock();
        }

        $this->clock = $clock;
    }

    /**
     * @param $o array|object
     * @return array
     */
    protected function object2array($o): array
    {
        $a = (array) $o;
        foreach ($a as &$v) {
            if (is_object($v) || is_array($v)) {
                $v = $this->object2array($v);
            }
        }
        return $a;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getFullPath(): string
    {
        $host    = $this->settings->host;
        $version = $this->settings->version;

        return "{$host}/v{$version}/{$this->uri}";
    }

    public function getParams(): array
    {
        if ($this->settings->version === V3Settings::VERSION_3) {
            return ['data' => $this->params];
        }

        return $this->params;
    }

    /**
     * @throws \RuntimeException
     */
    public function getHeaders(): array
    {
        switch ($this->settings->version) {
            case 2:
                return $this->getV2Headers();
            case 3:
                return $this->getV3Headers();
            default:
                throw new \RuntimeException("Unknown version number {$this->settings->version}!");
        }
    }

    private function getV2Headers(): array
    {
        $customerId  = $this->settings->customerId;
        $privateKey  = $this->settings->privateKey;
        $country     = $this->settings->country;
        $requestTime = $this->clock->getCurrentTimeInMilliseconds();
        $uuid        = $this->uuid->getUuid();
        $uri         = str_replace($this->settings->host, '', $this->getFullPath());
        $body        = $this->getParams();
        $method      = $this->getMethod();

        // generate sha256 signature
        $signatureVerifier = new SignatureVerifier();
        $signature = $signatureVerifier->calculate($uri, $body, $requestTime, $method, $privateKey);

        return [
            'Authorization' => "hmac {$customerId}:{$requestTime}:{$signature}",
            'Accept' => 'application/json',
            'Content-type' => 'application/json; charset=utf-8',
            'X-LLM-Country' => strtoupper($country),
            'X-Request_ID' => $uuid,
        ];
    }

    private function getV3Headers(): array
    {
        $secretKey   = $this->settings->apiSecret;
        $country     = $this->settings->country;
        $requestTime = $this->clock->getCurrentTimeInMilliseconds();
        $uuid        = $this->uuid->getUuid();
        $uri         = str_replace($this->settings->host, '', $this->getFullPath());
        $body        = $this->getParams();
        $method      = $this->getMethod();
        $publicKey   = $this->settings->apiKey;

        // generate sha256 signature
        $signatureVerifier = new SignatureVerifier();
        $signature = $signatureVerifier->calculate($uri, $body, $requestTime, $method, $secretKey);
        
        $headers = [
            // Regex for hmac:
            // /hmac ([A-Fa-f\d]{32}|(pk_test_|pk_prod_)[A-Fa-f\d]{32}):(\d{13}):([A-Fa-f\d]{64})/
            'Authorization' => "hmac {$publicKey}:{$requestTime}:{$signature}",
            'Accept' => 'application/json',
            'Content-type' => 'application/json',
            'Market' => strtoupper($country),
            'Request-ID' => $uuid,
        ];

        return $headers;
    }

    /**
     * @return V2Settings|V3Settings
     */
    public function getSettings()
    {
        return $this->settings;
    }


}