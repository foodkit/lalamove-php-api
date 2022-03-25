<?php

namespace Lalamove\Responses\V2;

class DriverResponse
{
    /** @var string */
    public $name;
    /** @var string */
    public $phone;

    /**
     * Pass in the deserialized JSON response to populate all relevant fields.
     * @param object $response
     */
    public function __construct($response = null)
    {
        $this->name = $response ? $response->name : null;
        $this->phone = $response ? $response->phone : null;
    }
}
