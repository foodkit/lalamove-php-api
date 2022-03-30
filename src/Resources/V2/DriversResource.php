<?php

namespace Lalamove\Resources\V2;

use Lalamove\Client\V2\Settings;
use Lalamove\Resources\AbstractResource;
use Lalamove\Responses\V2\DriverLocationResponse;
use Lalamove\Responses\V2\DriverResponse;

class DriversResource extends AbstractResource
{
    /**
     * OrdersResource constructor.
     */
    public function __construct(Settings $settings)
    {
        parent::__construct($settings);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Lalamove\Exceptions\LalamoveException
     */
    public function get(string $orderId, string $driverId): DriverResponse
    {
        $response = $this->send('GET', "orders/{$orderId}/drivers/{$driverId}");
       
        return new DriverResponse($response);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Lalamove\Exceptions\LalamoveException
     */
    public function getLocation(string $orderId, string $driverId): DriverLocationResponse
    {
        $response = $this->send('GET', "orders/{$orderId}/drivers/{$driverId}/location");
       
        return new DriverLocationResponse($response);
    }
}