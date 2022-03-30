<?php

declare(strict_types=1);

namespace Lalamove\Client\V3;

use Lalamove\Resources\V3\DriversResource;
use Lalamove\Resources\V3\OrdersResource;
use Lalamove\Resources\V3\QuotationsResource;
use Lalamove\Resources\V3\WebhookResource;

class Client
{
    protected Settings $settings;

    public function __construct(Settings $settings)
    {
        $this->settings = $settings;
    }

    public function quotations(): QuotationsResource
    {
        return new QuotationsResource($this->settings);
    }

    public function orders(): OrdersResource
    {
        return new OrdersResource($this->settings);
    }

    public function drivers(): DriversResource
    {
        return new DriversResource($this->settings);
    }

    public function webhooks(): WebhookResource
    {
        return new WebhookResource($this->settings);
    }
}