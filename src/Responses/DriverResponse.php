<?php

namespace Lalamove\Responses;

class DriverResponse
{
    /** @var string */
    public $name;
    /** @var string */
    public $phone;

    public function __construct($response)
    {
        $this->name = $response->name;
        $this->phone = $response->phone;
    }
}
