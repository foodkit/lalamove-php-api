<?php

namespace LalamoveTests\Mock;

use Lalamove\Http\LalamoveRequest;
use Lalamove\Http\TransportInterface;

class MockedExceptionThrowingTransport implements TransportInterface
{
    public function __construct(\Exception $ex)
    {
        $this->ex = $ex;
    }

    /**
     * @param LalamoveRequest $request
     * @return mixed|void
     * @throws \Exception
     */
    public function send(LalamoveRequest $request)
    {
        throw $this->ex;
    }
}