<?php

namespace Lalamove\Http;

interface TransportInterface
{
    /**
     * @param LalamoveRequest $request
     * @return mixed
     */
    public function send(LalamoveRequest $request);
}