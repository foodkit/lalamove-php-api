<?php

namespace Lalamove\Requests\V3;

class Location
{
    public $lat;
    public $lng;

    /**
     * Location constructor.
     * @param $lat
     * @param $lng
     */
    public function __construct($lat, $lng)
    {
        $this->lat = $lat;
        $this->lng = $lng;
    }

    /**
     * @param $lat
     * @param $lng
     * @return static
     */
    public static function make($lat, $lng)
    {
        return new static($lat, $lng);
    }
}