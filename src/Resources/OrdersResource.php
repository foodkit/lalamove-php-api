<?php

namespace Lalamove\Resources;

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
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function find($id)
    {
        return $this->send('GET', "orders/{$id}");
    }

    /**
     *
     */
    public function create($payload)
    {
        return $this->send('POST', "orders", $payload);
    }

    /**
     *
     */
    public function cancel($orderId)
    {
        return $this->send('PUT', "orders/{$orderId}/cancel");
    }
}