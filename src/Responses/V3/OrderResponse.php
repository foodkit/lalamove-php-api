<?php

namespace Lalamove\Responses\V3;

class OrderResponse
{
    public $orderId;
    public $quotationId;
    public $priceBreakdown;
    public $driverId;
    public $shareLink;
    public $status;
    public $distance;
    public $stops;

    /**
     * Pass in the deserialized JSON response to populate all relevant fields.
     * @param object $response
     */
    public function __construct($response = null)
    {
        $response = $response->data ?: null;

        if (!$response) {
            return;
        }

        $this->orderId = $response ? $response->orderId : null;
        $this->quotationId = $response ? $response->quotationId : null;
        $this->priceBreakdown = $response ? $response->priceBreakdown : null;
        $this->driverId = $response ? $response->driverId : null;
        $this->shareLink = $response ? $response->shareLink : null;
        $this->status = $response ? $response->status : null;
        $this->distance = $response ? $response->distance : null;
        $this->stops = $response ? $response->stops : null;
    }
}