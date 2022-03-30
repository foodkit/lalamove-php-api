<?php

declare(strict_types=1);

namespace Lalamove\Http\Clock;

class PslTimeClock implements ClockInterface
{
    public function getCurrentTimeInSeconds(): int
    {
        return time();
    }

    public function getCurrentTimeInMilliseconds(): int
    {
        return $this->getCurrentTimeInSeconds() * 1000;
    }
}