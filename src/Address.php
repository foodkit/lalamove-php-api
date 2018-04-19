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

    /**
     * Address constructor.
     * @param $displayString
     * @param string $city
     * @param string $country
     */
    public function __construct($displayString, $city = '', $country = '')
    {
        $this->displayString = $displayString;
        $this->city = $city;
        $this->country = $country;
    }

    /**
     * @param $displayString
     * @param $country
     * @return static
     */
    public static function make($displayString, $city, $country)
    {
        return new static($displayString, $city, $country);
    }
}