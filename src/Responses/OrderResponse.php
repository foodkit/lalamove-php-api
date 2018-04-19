<?php

namespace Lalamove\Responses;

class OrderResponse
{
    public $customerOrderId;
    public $orderRef;

    /**
     * QuotationResponse constructor.
     * @param object $response
     */
    public function __construct($response)
    {
        $this->customerOrderId = $response->customerOrderId;
        $this->orderRef = $response->orderRef;
    }
}