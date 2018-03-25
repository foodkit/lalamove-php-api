<?php

namespace Lalamove\Http;

class LalamoveRequest
{
    /** @var \Lalamove\Client\Settings */
    protected $settings;
    /** @var string */
    protected $method;
    /** @var string */
    protected $uri;
    /** @var array */
    protected $params;

    public function __construct($settings, $method = 'GET', $uri = '', $params = [])
    {
        $this->settings = $settings;
        $this->method = $method;
        $this->uri = $uri;
        $this->params = $params;
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
        $endpoint = $this->settings->endpoint;
        $version = $this->settings->version;

        return "{$endpoint}/v{$version}/{$this->uri}";
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
        $key = $this->settings->key;
        $secret = $this->settings->secret;
        $country = $this->settings->country;

        $requestTime = time() * 1000;

        $uuid = uniqid();
        $body = json_encode($this->params);
        $message = "{$requestTime}\r\n{$this->method}\r\n{$this->uri}\r\n\r\n";

        if ($this->method != 'GET') {
            $message .= $body;
        }

        $signature = hash_hmac("sha256", $message, $secret);

        return [
            'Authorization' => "hmac {$key}:{$requestTime}:{$signature}",
            'Accept' => 'application/json',
            'Content-type' => 'application/json; charset=utf-8',
            'X-LLM-Country' => strtoupper($country),
            'X-Request_ID' => $uuid
        ];
    }
}