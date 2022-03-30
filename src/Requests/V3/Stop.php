<?php

namespace Lalamove\Requests\V3;

class Stop
{
    /** @var string */
    public $stopId;

    /** @var Location */
    public $coordinates;

    /** @var array */
    public $address;

    /**
     * Stop constructor.
     * @param  string $stopId // from quotation
     * @param Location $coordinates
     * @param string $address
     */
    public function __construct($stopId, $coordinates, $address = '')
    {
        $this->stopId = $stopId;
        $this->coordinates = $coordinates;
        $this->address = $address;
    }

    /**
     * @param string $stopId
     * @param Location $coordinates
     * @param string $address
     * @return static
     */
    public static function make($stopId, $coordinates, $address = '')
    {
        return new static($stopId, $coordinates, $address);
    }
}
