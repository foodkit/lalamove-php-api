<?php

declare(strict_types=1);

namespace LalamoveTests\Mock;

use Lalamove\Http\LalamoveRequest;
use Lalamove\Http\TransportInterface;
use stdClass;

class MockedExceptionThrowingTransport implements TransportInterface
{
    public function __construct(\Exception $ex)
    {
        $this->ex = $ex;
    }

    public function send(LalamoveRequest $request): ?stdClass
    {
        throw $this->ex;
    }
}