<?php

declare(strict_types=1);

namespace LalamoveTests\Helpers;

use Lalamove\Client\V2\Settings;

class DummySettings extends Settings
{
    public function __construct($host = '', string $customerId = '', string $privateKey = '', string $country = '', int $version = 2)
    {
        parent::__construct([
            // These are NOT real, don't try and use them.
            'host' => 'https://www.domain.com',
            'customerId' => 'wgmsqqh208fxic9vcqwruk2tciicielf',
            'privateKey' => 'kGEX69NLd33+J/FQGdx8jOLAO1JZVPrHzQpuZDrWGxlftbu2tKFiVkptTSfPaj==',
            'country' => self::COUNTRY_SINGAPORE,
        ]);
    }
}