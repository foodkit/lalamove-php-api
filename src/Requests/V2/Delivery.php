<?php

namespace Lalamove\Requests\V2;

class Delivery
{
    /** @var int */
    public $toStop;
    /** @var Contact */
    public $toContact;
    /** @var string */
    public $remarks;

    /**
     * Delivery constructor.
     * @param $toStop
     * @param $toContact
     * @param string $remarks
     */
    public function __construct($toStop, $toContact, $remarks = '')
    {
        $this->toStop = $toStop;
        $this->toContact = $toContact;
        $this->remarks = $remarks;
    }

    /**
     * @param $toStop
     * @param $toContact
     * @param string $remarks
     * @return static
     */
    public static function make($toStop, $toContact, $remarks = '')
    {
        return new static($toStop, $toContact, $remarks);
    }
}
