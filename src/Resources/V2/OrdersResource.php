<?php

namespace Lalamove\Resources\V2;

use Lalamove\Client\V2\Settings;
use Lalamove\Http\GuzzleTransport;
use Lalamove\Requests\V2\Order;
use Lalamove\Resources\AbstractResource;
use Lalamove\Responses\V2\OrderDetailsResponse;
use Lalamove\Responses\V2\OrderResponse;
use LalamoveTests\Mock\MockedExceptionThrowingTransport;

class OrdersResource extends AbstractResource
{
    /**
     * OrdersResource constructor.
     */
    public function __construct(Settings $settings, GuzzleTransport|MockedExceptionThrowingTransport $transport = null)
    {
        parent::__construct($settings, $transport);
    }

    /**
     * @throws \Lalamove\Exceptions\LalamoveException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function details(string $id): OrderDetailsResponse
    {
        $response = $this->send('GET', "orders/{$id}");

        return new OrderDetailsResponse($response);
    }

    /**
     * @throws \Lalamove\Exceptions\LalamoveException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(Order $order): OrderResponse
    {
        $response = $this->send('POST', "orders", $order);

        return new OrderResponse($response);
    }

    /**
     * @throws \Lalamove\Exceptions\LalamoveException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function cancel(string $orderId): bool
    {
        $this->send('PUT', "orders/{$orderId}/cancel");

        return true;
    }
}