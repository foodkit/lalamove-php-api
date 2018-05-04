<?php

namespace Lalamove\Resources;

use Lalamove\Responses\DriverLocationResponse;
use Lalamove\Responses\DriverResponse;

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
     * @return DriverResponse
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