<?php

namespace Lalamove\Resources\V3;

use Lalamove\Requests\V3\Order;
use Lalamove\Resources\AbstractResource;
use Lalamove\Responses\V3\OrderDetailsResponse;
use Lalamove\Responses\V3\OrderResponse;

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
     * @return \Lalamove\Responses\V3\OrderDetailsResponse
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
     * @return \Lalamove\Responses\V3\OrderResponse
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
        $this->send('DELETE', "orders/{$orderId}");
        return true;
    }
}