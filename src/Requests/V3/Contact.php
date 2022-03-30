<?php

namespace Lalamove\Requests\V3;

class Contact
{

    public string $name;

    public string $phone;

    public string $stopId = '';

    /**
     * Contact constructor.
     */
    public function __construct(string $name, string $phone, $stopId = '')
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->stopId = $stopId;
    }

    public static function make(string $name, string $phone, string $stopId): static
    {
        return new static($name, $phone, $stopId);
    }
}