<?php

declare(strict_types=1);

namespace Lalamove\Resources\V3;

use Lalamove\Resources\AbstractResource;
use Lalamove\Responses\V3\DriverResponse;

class DriversResource extends AbstractResource
{
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Lalamove\Exceptions\LalamoveException
     */
    public function get(string $orderId, string $driverId): DriverResponse
    {
        $response = $this->send('GET', "orders/{$orderId}/drivers/{$driverId}");

        return new DriverResponse($response);
    }
}