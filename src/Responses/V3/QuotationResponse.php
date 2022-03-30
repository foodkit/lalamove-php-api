<?php

namespace Lalamove\Responses\V3;

use Lalamove\Requests\V3\Stop;
use Lalamove\Requests\V3\Item;
use Lalamove\Requests\V3\Location;
use Lalamove\Requests\V3\PriceBreakdown;

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

    public PriceBreakdown $priceBreakdown;

    public Item $item;

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

        if ($responseData->stops) {
            foreach($responseData->stops as $stop) {
                $this->stops[] = new Stop(
                    $stop->stopId ?? '', 
                    $stop->coordinates ? new Location($stop->coordinates->lat, $stop->coordinates->lng) : null,
                    $stop->address ?? '', 
                    $stop->name ?? '', 
                    $stop->phone ?? ''
                );
            }
        }

        $this->isRouteOptimized = $responseData->isRouteOptimized ?? null;

        $this->priceBreakdown = $responseData->priceBreakdown ? new PriceBreakdown(
            $responseData->priceBreakdown->base,
            $responseData->priceBreakdown->extraMileage ?? '',
            $responseData->priceBreakdown->surcharge ?? '',
            $responseData->priceBreakdown->totalExcludePriorityFee ?? '',
            $responseData->priceBreakdown->total ?? '',
            $responseData->priceBreakdown->currency ?? '',
            $responseData->priceBreakdown->priorityFee ?? '',
        ) : null;

        $this->item = $responseData->item ? new Item(
            $responseData->item->quantity ?? '',
            $responseData->item->weight ?? '',
            $responseData->item->categories ?? [],
            $responseData->item->handlingInstructions ?? []
        ) : null;
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