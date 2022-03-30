<?php

declare(strict_types=1);

namespace Lalamove\Requests\V3;

class Delivery
{
    public string $stopId;
    
    public string $name;
    
    public string $phone;

    public string $remarks;

    public function __construct(string $stopId, string $name, string $phone, string $remarks = '')
    {
        $this->stopId = $stopId;
        $this->name = $name;
        $this->phone = $phone;
        $this->remarks = $remarks;
    }

    public static function make(string $stopId, string $name, string $phone, string $remarks = ''): self
    {
        return new static($stopId, $name, $phone, $remarks);
    }
}
