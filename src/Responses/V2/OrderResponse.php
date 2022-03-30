<?php

namespace Lalamove\Responses\V2;

class OrderResponse
{
    public $customerOrderId;
    public $orderRef;

    /**
     * Pass in the deserialized JSON response to populate all relevant fields.
     * @param object $response
     */
    public function __construct($response = null)
    {
        $this->customerOrderId = $response ? $response->customerOrderId : null;
        $this->orderRef = $response ? $response->orderRef : null;
    }
}