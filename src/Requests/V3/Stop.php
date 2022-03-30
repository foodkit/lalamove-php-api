<?php

declare(strict_types=1);

namespace Lalamove\Requests\V3;

class Stop
{
    public string $stopId;

    public Location $coordinates;

    public string $address;

    public string $name;

    public string $phone;

    public function __construct(string $stopId, Location $coordinates, $address = '', $name = '', $phone = '')
    {
        $this->stopId = $stopId;
        $this->coordinates = $coordinates;
        $this->address = $address;
        $this->name = $name;
        $this->phone = $phone;
    }

    public static function make(string $stopId, Location $coordinates, $address = '', $name = '', $phone = '')
    {
        return new static($stopId, $coordinates, $address, $name, $phone);
    }
}
