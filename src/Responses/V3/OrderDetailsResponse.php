<?php

namespace Lalamove\Responses\V3;

class OrderDetailsResponse
{
    /** @var string */
    public $orderId;
    /** @var string */
    public $quotationId;
    /** @var string */
    public $priceBreakdown;
    /** @var string */
    public $driverId;
    /** @var string */
    public $shareLink;
    /** @var string */
    public $status;
    /** @var string */
    public $distance;
    /** @var string */
    public $stops;


    /**
     * Pass in the deserialized JSON response to populate all relevant fields.
     * @param object $response
     */
    public function __construct($response = null)
    {
        $response = $response->data ?? null;

        if (empty($response)) {
            return null;
        }

        $this->orderId = $response->orderId ?? null;
        $this->quotationId = $response->quotationId ?? null; 
        $this->priceBreakdown = $response->priceBreakdown ?? null; 
        $this->driverId = $response->driverId ?? null; 
        $this->shareLink = $response->shareLink ?? null; 
        $this->status = $response->status ?? null; 
        $this->distance = $response->distance ?? null; 
        $this->stops = $response->stops ?? null; 
    }
}