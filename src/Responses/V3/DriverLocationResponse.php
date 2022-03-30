<?php

declare(strict_types=1);

namespace Lalamove\Responses\V3;

use Lalamove\Requests\V3\Location;

class DriverLocationResponse
{
    public string $driverId;
    
    public string $name;
    
    public string $phone;
    
    public string $plateNumber;
    
    public string $photo;

    public ?Location $coordinates;

    public function __construct(object $response = null)
    {
        $this->driverId = $response ? $response->driverId : '';
        $this->name = $response ? $response->name : '';
        $this->phone = $response ? $response->phone : '';
        $this->plateNumber = $response ? $response->plateNumber : '';
        $this->photo = $response ? $response->photo : '';
        $this->coordinates = $response ? new Location($response->coordinates->lat, $response->coordinates->lng) : null;
    }
}
