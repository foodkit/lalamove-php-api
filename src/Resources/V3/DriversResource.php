<?php

namespace Lalamove\Resources\V3;

use Lalamove\Client\V3\Settings;
use Lalamove\Http\GuzzleTransport;
use Lalamove\Resources\AbstractResource;
use Lalamove\Responses\V3\DriverResponse;
use LalamoveTests\Helpers\DummySettings;
use LalamoveTests\Mock\MockedExceptionThrowingTransport;

class DriversResource extends AbstractResource
{
    /**
     * OrdersResource constructor.
     */
    public function __construct(Settings|DummySettings $settings, GuzzleTransport|MockedExceptionThrowingTransport $transport = null)
    {
        parent::__construct($settings, $transport);
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
}