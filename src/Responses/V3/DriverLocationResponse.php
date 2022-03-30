<?php

namespace Lalamove\Responses\V3;

use Lalamove\Requests\V3\Location;

class DriverLocationResponse
{
    public $driverId;
    public $name;
    public $phone;
    public $plateNumber;
    public $photo;
    public $coordinates;

    /**
     * Pass in the deserialized JSON response to populate all relevant fields.
     * @param object $response
     */
    public function __construct($response = null)
    {
        $this->driverId = $response ? $response->driverId : "";
        $this->name = $response ? $response->name : "";
        $this->phone = $response ? $response->phone : "";
        $this->plateNumber = $response ? $response->plateNumber : "";
        $this->photo = $response ? $response->photo : "";
        $this->coordinates = $response ? $response->coordinates : null;
    }
}
