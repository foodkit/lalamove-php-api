<?php

declare(strict_types=1);

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
    
    public function __construct($response = null)
    {
        $response = $response->data ?? null;
        $this->driverId = $response ? $response->driverId : '';
        $this->name = $response ? $response->name : '';
        $this->phone = $response ? $response->phone : '';
        $this->plateNumber = $response ? $response->plateNumber : '';
        $this->photo = $response ? $response->photo : '';

        $this->coordinates = null;

        if ($response && $response->coordinates) {
            $this->coordinates = new Location($response->coordinates->lat, $response->coordinates->lng);
        }
    }
}
