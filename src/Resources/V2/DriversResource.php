<?php

namespace Lalamove\Resources\V2;

use Lalamove\Resources\AbstractResource;
use Lalamove\Responses\V2\DriverLocationResponse;
use Lalamove\Responses\V2\DriverResponse;

class DriversResource extends AbstractResource
{
    /**
     * OrdersResource constructor.
     * @param $settings
     */
    public function __construct($settings)
    {
        parent::__construct($settings);
    }

    /**
     * @param $orderId
     * @param $driverId
     * @return \Lalamove\Responses\V2\DriverResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Lalamove\Exceptions\LalamoveException
     */
    public function get($orderId, $driverId)
    {
        $response = $this->send('GET', "orders/{$orderId}/drivers/{$driverId}");
        return new DriverResponse($response);
    }

    /**
     * @param $orderId
     * @param $driverId
     * @return DriverLocationResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Lalamove\Exceptions\LalamoveException
     */
    public function getLocation($orderId, $driverId)
    {
        $response = $this->send('GET', "orders/{$orderId}/drivers/{$driverId}/location");
        return new DriverLocationResponse($response);
    }
}