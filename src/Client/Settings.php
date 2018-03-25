<?php

namespace Lalamove\Client;

class Settings
{
    public $endpoint;
    public $key;
    public $secret;
    public $country;
    public $version;

    /**
     * @param string $endpoint
     * @param string $key
     * @param string $secret
     * @param string $country
     * @param int $version
     */
    public function __construct($endpoint, $key, $secret, $country, $version = 2)
    {
        $this->endpoint = $endpoint;
        $this->key = $key;
        $this->secret = $secret;
        $this->country = $country;
        $this->version = $version;
    }
}