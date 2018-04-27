<?php

namespace Lalamove\Responses;

class OrderDetailsResponse
{
    const STATE_ASSIGNING_DRIVER = 'ASSIGNING_DRIVER';
    const STATE_ON_GOING = 'ON_GOING';
    const STATE_PICKED_UP = 'PICKED_UP';
    const STATE_COMPLETED = 'COMPLETED';
    const STATE_EXPIRED = 'EXPIRED';
    const STATE_CANCELED = 'CANCELED';
    const STATE_REJECTED = 'REJECTED';

    public $driverId;
    public $status;

    /**
     * Pass in the deserialized JSON response to populate all relevant fields.
     * @param object $response
     */
    public function __construct($response = null)
    {
        $this->driverId = $response ? $response->driverId : null;
        $this->status = $response ? $response->status : null;
    }
}