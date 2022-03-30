<?php

namespace Lalamove\Http;

use stdClass;

interface TransportInterface
{
    public function send(LalamoveRequest $request): null | stdClass;
}