<?php

declare(strict_types=1);

namespace Lalamove\Client\V3;

use Psr\Log\LoggerInterface;

class Settings
{
    const COUNTRY_HONGKONG = 'HK';
    const COUNTRY_PHILIPPINES = 'PH';
    const COUNTRY_SINGAPORE = 'SG';
    const COUNTRY_THAILAND = 'TH';
    const COUNTRY_TAIWAN = 'TW';
    const VERSION_3 = 3;
    
    public string $host;
    
    public string $apiKey;
    
    public string $apiSecret;
    
    public string $country;
    
    public int $version;
    
    public ?LoggerInterface $logger = null;

    /**
     * Pass in either individual settings:
     *
     * $settings = new Settings('host.com', 'API_KEY', 'API_SECRET', 'TH', 3)
     */
    public function __construct(
        $host,
        $apiKey = '',
        $apiSecret = '',
        $country = '',
        $version = self::VERSION_3,
        LoggerInterface $logger = null
    ) {
        $this->host       = $host;
        $this->apiKey     = $apiKey;
        $this->apiSecret  = $apiSecret;
        $this->country    = $country;
        $this->version    = $version;
        $this->logger     = $logger;
    }
}