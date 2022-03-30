<?php

namespace Lalamove\Requests\V3;

class Contact
{
    public $name;
    public $phone;
    public $stopId = '';

    /**
     * Contact constructor.
     * @param $name
     * @param $phone
     */
    public function __construct($name, $phone, $stopId = '')
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->stopId = $stopId;
    }

    /**
     * @param $name
     * @param $phone
     * @return static
     */
    public static function make($name, $phone, $stopId)
    {
        return new static($name, $phone, $stopId);
    }
}