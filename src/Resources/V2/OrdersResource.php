<?php

declare(strict_types=1);

namespace Lalamove\Resources\V2;

use Lalamove\Client\V2\Settings;
use Lalamove\Http\TransportInterface;
use Lalamove\Requests\V2\Order;
use Lalamove\Resources\AbstractResource;
use Lalamove\Responses\V2\OrderDetailsResponse;
use Lalamove\Responses\V2\OrderResponse;

class OrdersResource extends AbstractResource
{
    public function __construct(Settings $settings, TransportInterface $transport = null)
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