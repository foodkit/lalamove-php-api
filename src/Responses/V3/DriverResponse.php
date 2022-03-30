<?php

namespace Lalamove\Responses\V3;

use Lalamove\Requests\V3\Location;

class DriverResponse
{
    public string $driverId;

    public string $name;

    public string $phone;

    public string $plateNumber;

    public string $photo;

    public Location $coordinates;

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

        $this->driverId = $response ? $response->driverId : "";
        $this->name = $response ? $response->name : "";
        $this->phone = $response ? $response->phone : "";
        $this->plateNumber = $response ? $response->plateNumber : "";
        $this->photo = $response ? $response->photo : "";
        $this->coordinates = $response ? new Location($response->coordinates->lat, $response->coordinates->lng) : null;
    }
}
