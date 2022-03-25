<?php

namespace Lalamove\Http;

use Lalamove\Http\Clock\ClockInterface;
use Lalamove\Http\Clock\PslTimeClock;
use Lalamove\Http\Uuid\PslUniqidGenerator;
use Lalamove\Http\Uuid\UuidGeneratorInterface;

class LalamoveRequest
{
    protected $settings;
    /** @var string */
    protected $method;
    /** @var string */
    protected $uri;
    /** @var array */
    protected $params;
    /** @var UuidGeneratorInterface */
    protected $uuid;
    /** @var ClockInterface */
    protected $clock;

    /**
     * LalamoveRequest constructor.
     * @param $settings
     * @param string $method
     * @param string $uri
     * @param array $params
     * @param UuidGeneratorInterface|null $uuid
     * @param ClockInterface $clock
     */
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
     * @param $o
     * @return array
     */
    protected function object2array($o)
    {
        $a = (array)$o;
        foreach ($a as &$v) {
            if (is_object($v) || is_array($v)) {
                $v = $this->object2array($v);
            }
        }
        return $a;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @return string
     */
    public function getFullPath()
    {
        $host    = $this->settings->host;
        $version = $this->settings->version;
        return "{$host}/v{$version}/{$this->uri}";
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @return array
     */
    public function getHeaders()
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
        $customerId = $this->settings->customerId;
        $privateKey = $this->settings->privateKey;
        $country    = $this->settings->country;

        $requestTime = $this->clock->getCurrentTimeInMilliseconds();

        $uuid = $this->uuid->getUuid();
        $uri  = str_replace($this->settings->host, '', $this->getFullPath());

        $body    = json_encode($this->getParams());
        $message = "{$requestTime}\r\n{$this->method}\r\n{$uri}\r\n\r\n";

        if ($this->method != 'GET') {
            $message .= $body;
        }

        $signature = hash_hmac("sha256", $message, $privateKey);

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
        $secretKey = $this->settings->apiSecret;
        $country    = $this->settings->country;

        $requestTime = $this->clock->getCurrentTimeInMilliseconds();

        $uuid = $this->uuid->getUuid();
        $uri  = str_replace($this->settings->host, '', $this->getFullPath());

        $body    = json_encode($this->getParams());
        $message = "{$requestTime}\r\n{$this->method}\r\n{$uri}\r\n\r\n";

        if ($this->method != 'GET') {
            $message .= $body;
        }

        $publicKey = $this->settings->apiKey;

        $signature = hash_hmac('sha256', $message, $secretKey);

        $headers = [
            // Regex:
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
     * @todo: replace typing
     */
    public function getSettings()
    {
        return $this->settings;
    }


}