<?php

namespace Lalamove\Requests\V3;

class Distance
{
    public string $value;

    public string $unit;

    /**
     * Distance constructor.
     */
    public function __construct(string $value, string $unit)
    {
        $this->value = $value;
        $this->unit = $unit;
    }

    public static function make(string $value, string $unit): static
    {
        return new static($value, $unit);
    }
}