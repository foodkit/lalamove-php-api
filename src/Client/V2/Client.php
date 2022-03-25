<?php

namespace Lalamove\Client\V2;

use Lalamove\Resources\V2\DriversResource;
use Lalamove\Resources\V2\OrdersResource;
use Lalamove\Resources\V2\QuotationsResource;

class Client
{
    protected $settings;

    public function __construct(Settings $settings)
    {
        $this->settings = $settings;
    }

    /**
     * @return \Lalamove\Resources\V2\OrdersResource
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

    /**
     * @return DriversResource
     */
    public function drivers()
    {
        return new DriversResource($this->settings);
    }
}