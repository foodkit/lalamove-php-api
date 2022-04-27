<?php

declare(strict_types=1);

namespace Lalamove\Responses\V3;

use Lalamove\Requests\V3\Stop;
use Lalamove\Requests\V3\Distance;
use Lalamove\Requests\V3\Location;
use Lalamove\Requests\V3\PriceBreakdown;

class OrderResponse
{
    public string $orderId;

    public string $quotationId;

    public PriceBreakdown $priceBreakdown;

    public string $driverId;

    public string $shareLink;

    public string $status;

    public Distance $distance;

    /** @var Stop[] */
    public array $stops;


    /**
     * Pass in the deserialized JSON response to populate all relevant fields.
     */
    public function __construct(object $response = null)
    {
        $response = $response->data ?? null;

        if (empty($response)) {
            return null;
        }

        $this->orderId = $response->orderId;
        $this->quotationId = $response->quotationId;

        $this->priceBreakdown = $response->priceBreakdown ? new PriceBreakdown(
            $response->priceBreakdown->base,
            $response->priceBreakdown->extraMileage ?? '',
            $response->priceBreakdown->surcharge ?? '',
            $response->priceBreakdown->totalExcludePriorityFee ?? '',
            $response->priceBreakdown->total ?? '',
            $response->priceBreakdown->currency ?? '',
            $response->priceBreakdown->priorityFee ?? '',
        ) : null; 

        $this->driverId = $response->driverId;
        $this->shareLink = $response->shareLink;
        $this->status = $response->status;
        $this->distance = $response->distance ? new Distance($response->distance->value, $response->distance->unit) : null;

        if ($response->stops) {
            foreach($response->stops as $stop) {
                $this->stops[] = new Stop(
                    $stop->stopId ?? '', 
                    $stop->coordinates ? new Location($stop->coordinates->lat, $stop->coordinates->lng) : null,
                    $stop->address ?? '', 
                    $stop->name ?? '', 
                    $stop->phone ?? ''
                );
            }
        }
    }
}