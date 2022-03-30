<?php

namespace Lalamove\Responses\V2;

class OrderResponse
{
    public string $customerOrderId;
    
    public string $orderRef;

    /**
     * Pass in the deserialized JSON response to populate all relevant fields.
     */
    public function __construct(object $response = null)
    {
        $this->customerOrderId = $response ? $response->customerOrderId : null;
        $this->orderRef = $response ? $response->orderRef : null;
    }
}