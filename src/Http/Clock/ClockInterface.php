<?php

declare(strict_types=1);

namespace Lalamove\Http\Clock;

interface ClockInterface
{
    public function getCurrentTimeInSeconds(): int;

    /**
     * @return float|int
     */
    public function getCurrentTimeInMilliseconds();
}