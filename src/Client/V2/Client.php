<?php

declare(strict_types=1);

namespace Lalamove\Client\V2;

use Lalamove\Resources\V2\DriversResource;
use Lalamove\Resources\V2\OrdersResource;
use Lalamove\Resources\V2\QuotationsResource;

class Client
{
    protected Settings $settings;

    public function __construct(Settings $settings)
    {
        $this->settings = $settings;
    }

    public function orders(): OrdersResource
    {
        return new OrdersResource($this->settings);
    }

    public function quotations(): QuotationsResource
    {
        return new QuotationsResource($this->settings);
    }

    public function drivers(): DriversResource
    {
        return new DriversResource($this->settings);
    }
}