<?php

namespace Lalamove\Responses;

use Lalamove\Location;

class DriverLocationResponse
{
    /** @var Location */
    public $location;
    /** @var $string */
    public $updatedAt;

    public function __construct($response)
    {
        $this->location = new Location($response->location->lat, $response->location->lng);
        $this->updatedAt = $response->updatedAt;
    }
}
