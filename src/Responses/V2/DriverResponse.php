<?php

namespace Lalamove\Responses\V2;

class DriverResponse
{
    public string $name;

    public string $phone;

    /**
     * Pass in the deserialized JSON response to populate all relevant fields.
     */
    public function __construct(object $response = null)
    {
        $this->name = $response ? $response->name : null;
        $this->phone = $response ? $response->phone : null;
    }
}
