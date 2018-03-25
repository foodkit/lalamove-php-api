<?php

namespace Lalamove\Client;

use Lalamove\Resources\OrdersResource;
use Lalamove\Resources\QuotationsResource;

class Client
{
    protected $settings;
    
    public function __construct(Settings $settings)
    {
        $this->settings = $settings;
    }

    /**
     * @return OrdersResource
     */
    public function orders()
    {
        return new OrdersResource($this->settings);
    }

    /**
     * @return QuotationsResource
     */
    public function quotations()
    {
        return new QuotationsResource($this->settings);
    }
}