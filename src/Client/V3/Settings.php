<?php

declare(strict_types=1);

namespace Lalamove\Client\V3;

use Psr\Log\LoggerInterface;

class Settings
{
    public const COUNTRY_HONGKONG = 'HK';
    public const COUNTRY_PHILIPPINES = 'PH';
    public const COUNTRY_SINGAPORE = 'SG';
    public const COUNTRY_THAILAND = 'TH';
    public const COUNTRY_TAIWAN = 'TW';

    public const VERSION_3 = 3;
    
    public string $host;
    
    public string $apiKey;
    
    public string $apiSecret;
    
    public string $country;
    
    public int $version;
    
    public ?LoggerInterface $logger = null;

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