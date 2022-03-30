<?php

namespace Lalamove\Responses\V3;

class QuotationResponse
{
    /** @var string  */
    public $quotationId;

    /** @var string */
    public $scheduleAt;

    /** @var string */
    public $expiresAt; // UTC timezone and ISO 8601 format

    /** @var string */
    public $serviceType;

    /** @var string */
    public $language;

    /** @var array */
    public $specialRequests; // COD, HELP_BUY, LALABAG

    /** @var Stop[] */
    public $stops;
   
    /** @var boolean  */
    public $isRouteOptimized;

    /** @var string  */
    public $priceBreakdown;

    /** @var Item */
    public $item;

    /**
     * Pass in the deserialized JSON response to populate all relevant fields.
     * @param object $response
     */
    public function __construct($response = null)
    {
        $responseData = $response->data ?: null;

        if (!$responseData) {
            return;
        }

        $this->quotationId = $responseData->quotationId ?? null;
        $this->scheduleAt = $responseData->scheduleAt ?? null;
        $this->expiresAt = $responseData->expiresAt ?? null;
        $this->serviceType = $responseData->serviceType ?? null;
        $this->language = $responseData->language ?? null;
        $this->specialRequests = $responseData->specialRequests ?? null;
        $this->stops = $responseData->stops ?? null;
        $this->isRouteOptimized = $responseData->isRouteOptimized ?? null;
        $this->priceBreakdown = $responseData->priceBreakdown ?? null;
        $this->item = $responseData->item ?? null;
    }

    /**
     * 
     * @return Stop[]
     */
    public function getRecipientStops()
    {
        if (empty($this->stops)) {
            return null;
        }

        return array_slice($this->stops, 1);
    }

    /**
     * 
     * @return Stop
     */
    public function getSenderStop()
    {
        if (empty($this->stops)) {
            return null;
        }

        return $this->stops[0];
    }
}