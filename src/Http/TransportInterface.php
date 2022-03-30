<?php

declare(strict_types=1);

namespace Lalamove\Http;

use stdClass;

interface TransportInterface
{
    public function send(LalamoveRequest $request): ?stdClass;
}