<?php

namespace Lalamove\Client;

class Settings
{
    public $host;
    public $customerId;
    public $privateKey;
    public $country;
    public $version;

    const COUNTRY_HONGKONG = 'HK';
    const COUNTRY_PHILIPPINES = 'PH';
    const COUNTRY_SINGAPORE = 'SG';
    const COUNTRY_THAILAND = 'TH';
    const COUNTRY_TAIWAN = 'TW';

    const VERSION_2 = 2;

    /**
     * @param string|array $host
     * @param string $customerId
     * @param string $privateKey
     * @param string $country
     * @param int $version
     */
    public function __construct($host, $customerId = '', $privateKey = '', $country = '', $version = self::VERSION_2)
    {
        $this->host = $host;
        $this->customerId = $customerId;
        $this->privateKey = $privateKey;
        $this->country = $country;
        $this->version = $version;

        if (is_array($host)) {
            foreach ($host as $key => $value) {
                $this->{$key} = !empty($value) ? $value : $this->{$key};
            }
        }
    }
}