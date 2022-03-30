<?php

declare(strict_types=1);

namespace Lalamove\Requests\V3;

class Distance
{
    public string $value;

    public string $unit;

    public function __construct(string $value, string $unit)
    {
        $this->value = $value;
        $this->unit = $unit;
    }

    public static function make(string $value, string $unit): self
    {
        return new static($value, $unit);
    }
}