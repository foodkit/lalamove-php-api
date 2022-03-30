<?php

namespace Lalamove\Requests\V3;

class Delivery
{
    /** @var string */
    public $stopId;
    
    /** @var string */
    public $name;
    
    /** @var string */
    public $phone;

    /** @var string */
    public $remarks;

    /**
     * Delivery constructor.
     * @param string $stopId
     * @param string $name
     * @param string $phone
     * @param string $remarks
     */
    public function __construct($stopId, $name, $phone, $remarks = '')
    {
        $this->stopId = $stopId;
        $this->name = $name;
        $this->phone = $phone;
        $this->remarks = $remarks;
    }

    /**
     * @param string $stopId
     * @param string $name
     * @param string $phone
     * @param string $remarks
     * @return static
     */
    public static function make($stopId, $name, $phone, $remarks = '')
    {
        return new static($stopId, $name, $phone, $remarks);
    }
}
