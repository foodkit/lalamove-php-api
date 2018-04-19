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

    public function __construct($response)
    {
        $this->driverId = $response->driverId;
        $this->status = $response->status;
    }
}