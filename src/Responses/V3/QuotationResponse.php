<?php

declare(strict_types=1);

namespace Lalamove\Responses\V3;

use Lalamove\Requests\V3\Stop;
use Lalamove\Requests\V3\Item;
use Lalamove\Requests\V3\Location;
use Lalamove\Requests\V3\PriceBreakdown;

class QuotationResponse
{
    public string $quotationId;

    public string $scheduleAt;

    public string $expiresAt; // UTC timezone and ISO 8601 format

    public string $serviceType;

    public string $language;

    /** @var string[] */
    public array $specialRequests = []; // COD, HELP_BUY, LALABAG

    /** @var Stop[] */
    public array $stops = [];

    public bool $isRouteOptimized;

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

        $this->quotationId = $responseData->quotationId;
        $this->scheduleAt = $responseData->scheduleAt;
        $this->expiresAt = $responseData->expiresAt;
        $this->serviceType = $responseData->serviceType;
        $this->language = $responseData->language;
        $this->specialRequests = $responseData->specialRequests ?? [];

        foreach($responseData->stops ?: [] as $stop) {
            $this->stops[] = new Stop(
                $stop->stopId ?? '',
                $stop->coordinates ? new Location($stop->coordinates->lat, $stop->coordinates->lng) : null,
                $stop->address ?? '',
                $stop->name ?? '',
                $stop->phone ?? ''
            );
        }

        $this->isRouteOptimized = $responseData->isRouteOptimized;

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
     * @return Stop[]
     */
    public function getRecipientStops(): array
    {
        if (empty($this->stops)) {
            return [];
        }
        return array_slice($this->stops, 1);
    }

    public function getSenderStop(): ?Stop
    {
        return $this->stops[0] ?? null;
    }
}