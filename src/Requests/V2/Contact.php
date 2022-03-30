<?php

declare(strict_types=1);

namespace Lalamove\Requests\V2;

class Contact
{
    public string $name;

    public string $phone;

    public function __construct(string $name, string $phone)
    {
        $this->name = $name;
        $this->phone = $phone;
    }

    public static function make(string $name, string $phone): self
    {
        return new static($name, $phone);
    }
}