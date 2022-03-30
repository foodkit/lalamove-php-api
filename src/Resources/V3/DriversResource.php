<?php

namespace Lalamove\Resources\V3;

use Lalamove\Resources\AbstractResource;
use Lalamove\Responses\V3\DriverResponse;

class DriversResource extends AbstractResource
{
    /**
     * OrdersResource constructor.
     * @param $settings
     */
    public function __construct($settings, $transport = null)
    {
        parent::__construct($settings, $transport);
    }

    /**
     * @param $orderId
     * @param $driverId
     * @return \Lalamove\Responses\V3\DriverResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Lalamove\Exceptions\LalamoveException
     */
    public function get($orderId, $driverId)
    {
        $response = $this->send('GET', "orders/{$orderId}/drivers/{$driverId}");
        return new DriverResponse($response);
    }
}