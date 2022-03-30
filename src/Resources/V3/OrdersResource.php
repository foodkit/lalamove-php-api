<?php

declare(strict_types=1);

namespace Lalamove\Resources\V3;

use Lalamove\Requests\V3\Order;
use Lalamove\Resources\AbstractResource;
use Lalamove\Responses\V3\OrderDetailsResponse;
use Lalamove\Responses\V3\OrderResponse;

class OrdersResource extends AbstractResource
{
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
     * @param $orderId
     * @return bool
     * @throws \Lalamove\Exceptions\LalamoveException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function cancel(string $orderId): bool
    {
        $this->send('DELETE', "orders/{$orderId}");
      
        return true;
    }
}