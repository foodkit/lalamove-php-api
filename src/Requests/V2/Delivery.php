<?php

namespace Lalamove\Requests\V2;

class Delivery
{
    public int $toStop;

    public Contact $toContact;

    public string $remarks;

    /**
     * Delivery constructor.
     */
    public function __construct(int $toStop, Contact $toContact, $remarks = '')
    {
        $this->toStop = $toStop;
        $this->toContact = $toContact;
        $this->remarks = $remarks;
    }

    public static function make(int $toStop, Contact $toContact, $remarks = ''): static
    {
        return new static($toStop, $toContact, $remarks);
    }
}
