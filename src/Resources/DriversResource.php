<?php

namespace Lalamove\Resources;

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
     *
     */
    public function get($orderId, $driverId)
    {
        return $this->send('GET', "orders/{$orderId}/{$driverId}");
    }

    /**
     *
     */
    public function getLocation($orderId, $driverId)
    {
        return $this->send('GET', "orders/{$orderId}/{$driverId}/location");
    }
}