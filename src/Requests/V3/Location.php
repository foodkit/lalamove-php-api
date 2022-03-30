<?php

namespace Lalamove\Requests\V3;

class Location
{
    public string $lat;

    public string $lng;

    /**
     * Location constructor.
     */
    public function __construct(string $lat, string $lng)
    {
        $this->lat = $lat;
        $this->lng = $lng;
    }

    public static function make(string $lat, string $lng): static
    {
        return new static($lat, $lng);
    }
}