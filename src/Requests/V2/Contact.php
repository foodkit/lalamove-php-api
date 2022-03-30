<?php

namespace Lalamove\Requests\V2;

class Contact
{
    public string $name;

    public string $phone;

    /**
     * Contact constructor.
     */
    public function __construct(string $name, string $phone)
    {
        $this->name = $name;
        $this->phone = $phone;
    }

    public static function make(string $name, string $phone): static
    {
        return new static($name, $phone);
    }
}