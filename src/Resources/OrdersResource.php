<?php

namespace Lalamove\Resources;

use Lalamove\Order;
use Lalamove\Responses\OrderDetailsResponse;
use Lalamove\Responses\OrderResponse;

class OrdersResource extends AbstractResource
{
    /**
     * OrdersResource constructor.
     * @param $settings
     * @param null $transport
     */
    public function __construct($settings, $transport = null)
    {
        parent::__construct($settings, $transport);
    }

    /**
     * @param $id
     * @return OrderDetailsResponse
     * @throws \Lalamove\Exceptions\LalamoveException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function details($id)
    {
        $response = $this->send('GET', "orders/{$id}");
        return new OrderDetailsResponse($response);
    }

    /**
     * @param Order $order
     * @return OrderResponse
     * @throws \Lalamove\Exceptions\LalamoveException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(Order $order)
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
    public function cancel($orderId)
    {
        $this->send('PUT', "orders/{$orderId}/cancel");
        return true;
    }
}