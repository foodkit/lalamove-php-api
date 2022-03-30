<?php

declare(strict_types=1);

namespace Lalamove\Responses\V2;

class OrderDetailsResponse
{
    public const STATE_ASSIGNING_DRIVER = 'ASSIGNING_DRIVER';
    public const STATE_ON_GOING = 'ON_GOING';
    public const STATE_PICKED_UP = 'PICKED_UP';
    public const STATE_COMPLETED = 'COMPLETED';
    public const STATE_EXPIRED = 'EXPIRED';
    public const STATE_CANCELED = 'CANCELED';
    public const STATE_REJECTED = 'REJECTED';

    public ?string $driverId;

    public ?string $status;

    public function __construct(object $response = null)
    {
        $this->driverId = $response ? $response->driverId : null;
        $this->status = $response ? $response->status : null;
    }
}