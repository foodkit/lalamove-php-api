<?php

namespace Lalamove\Responses;

use Lalamove\Location;

class DriverLocationResponse
{
    /** @var Location */
    public $location;
    /** @var $string */
    public $updatedAt;

    /**
     * Pass in the deserialized JSON response to populate all relevant fields.
     * @param object $response
     */
    public function __construct($response = null)
    {
        $this->location = $response ? new Location($response->location->lat, $response->location->lng) : null;
        $this->updatedAt = $response ? $response->updatedAt : null;
    }
}
