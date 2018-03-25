<?php

namespace Lalamove\Resources;

class OrdersResource extends AbstractResource
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
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->send('GET', "orders/{$id}");
    }

    /**
     * 
     */
    public function create()
    {

    }
}