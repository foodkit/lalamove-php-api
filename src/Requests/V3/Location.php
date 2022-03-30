<?php

declare(strict_types=1);

namespace Lalamove\Requests\V3;

class Location
{
    public string $lat;

    public string $lng;

    public function __construct(string $lat, string $lng)
    {
        $this->lat = $lat;
        $this->lng = $lng;
    }

    public static function make(string $lat, string $lng): self
    {
        return new static($lat, $lng);
    }
}