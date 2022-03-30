<?php

namespace Lalamove\Requests\V2;

class Contact
{
    public $name;
    public $phone;

    /**
     * Contact constructor.
     * @param $name
     * @param $phone
     */
    public function __construct($name, $phone)
    {
        $this->name = $name;
        $this->phone = $phone;
    }

    /**
     * @param $name
     * @param $phone
     * @return static
     */
    public static function make($name, $phone)
    {
        return new static($name, $phone);
    }
}