<?php

namespace Lalamove\Responses\V2;

use Lalamove\Requests\V2\Location;

class DriverLocationResponse
{
    public Location $location;

    public string $updatedAt;

    /**
     * Pass in the deserialized JSON response to populate all relevant fields.
     */
    public function __construct(object $response = null)
    {
        $this->location = $response ? new Location($response->location->lat, $response->location->lng) : null;
        $this->updatedAt = $response ? $response->updatedAt : null;
    }
}
