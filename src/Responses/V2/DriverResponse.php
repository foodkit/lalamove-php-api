<?php

declare(strict_types=1);

namespace Lalamove\Responses\V2;

class DriverResponse
{
    public ?string $name;

    public ?string $phone;

    public function __construct(object $response = null)
    {
        $this->name = $response ? $response->name : null;
        $this->phone = $response ? $response->phone : null;
    }
}
