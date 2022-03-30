<?php

declare(strict_types=1);

namespace Lalamove\Responses\V2;

class OrderResponse
{
    public ?string $customerOrderId;
    
    public ?string $orderRef;

    public function __construct(object $response = null)
    {
        $this->customerOrderId = $response ? $response->customerOrderId : null;
        $this->orderRef = $response ? $response->orderRef : null;
    }
}