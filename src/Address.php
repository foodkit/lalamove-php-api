<?php

namespace Lalamove;

class Address
{
    /** @var string */
    public $displayString;
    /** @var string */
    public $country;
    /** @var string */
    public $city;
    /** @var string */
    public $floor;
    /** @var string */
    public $room;
    /** @var string */
    public $remarks;

    /**
     * Address constructor.
     * @param $displayString
     * @param string $city
     * @param string $country
     * @param null $floor
     * @param null $room
     * @param null $remarks
     */
    public function __construct($displayString, $city = '', $country = '', $floor = null, $room = null, $remarks = null)
    {
        $this->displayString = $displayString;
        $this->city = $city;
        $this->country = $country;
        $this->floor = $floor;
        $this->room = $room;
        $this->remarks = $remarks;
    }

    /**
     * @param $displayString
     * @param $city
     * @param $country
     * @param null $floor
     * @param null $room
     * @param null $remarks
     * @return static
     */
    public static function make($displayString, $city, $country, $floor = null, $room = null, $remarks = null)
    {
        return new static($displayString, $city, $country, $floor, $room, $remarks);
    }
}