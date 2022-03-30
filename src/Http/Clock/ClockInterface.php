<?php

namespace Lalamove\Http\Clock;

interface ClockInterface
{
    public function getCurrentTimeInSeconds(): int;
    public function getCurrentTimeInMilliseconds(): float|int;
}