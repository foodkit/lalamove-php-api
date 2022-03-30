<?php

declare(strict_types=1);

namespace Lalamove\Client\V2;

use Psr\Log\LoggerInterface;

class Settings
{
    /** @var string|array */
    public $host;
    public string $customerId;
    public string $privateKey;
    public string $country;
    public int $version;
    public ?LoggerInterface $logger = null;

    public const COUNTRY_HONGKONG = 'HK';
    public const COUNTRY_PHILIPPINES = 'PH';
    public const COUNTRY_SINGAPORE = 'SG';
    public const COUNTRY_THAILAND = 'TH';
    public const COUNTRY_TAIWAN = 'TW';

    public const VERSION_2 = 2;

    /**
     * Pass in either individual settings:
     *
     * $settings = new Settings('host.com', '1234567890', // etc...
     *
     * ... or an associative array of settings:
     *
     * $settings = new Settings(['host' => 'host.com', 'customerId' => '1234567890', 'privateKey' => // etc...
     */
    public function __construct(
        $host,
        $customerId = '',
        $privateKey = '',
        $country = '',
        $version = self::VERSION_2,
        LoggerInterface $logger = null
    ) {
        $this->host       = $host;
        $this->customerId = $customerId;
        $this->privateKey = $privateKey;
        $this->country    = $country;
        $this->version    = $version;
        $this->logger     = $logger;

        if (is_array($host)) {
            foreach ($host as $key => $value) {
                $this->{$key} = !empty($value) ? $value : $this->{$key};
            }
        }
    }
}