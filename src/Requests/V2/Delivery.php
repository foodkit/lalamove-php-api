<?php

declare(strict_types=1);

namespace Lalamove\Requests\V2;

class Delivery
{
    public int $toStop;

    public Contact $toContact;

    public string $remarks;

    public function __construct(int $toStop, Contact $toContact, $remarks = '')
    {
        $this->toStop = $toStop;
        $this->toContact = $toContact;
        $this->remarks = $remarks;
    }

    public static function make(int $toStop, Contact $toContact, $remarks = ''): self
    {
        return new static($toStop, $toContact, $remarks);
    }
}
