<?php

namespace Lalamove\Client\V3;

use Lalamove\Resources\V3\QuotationsResource;

class Client
{
    protected $settings;

    public function __construct(Settings $settings)
    {
        $this->settings = $settings;
    }

    /**
     * @return QuotationsResource
     */
    public function quotations()
    {
        return new QuotationsResource($this->settings);
    }
}