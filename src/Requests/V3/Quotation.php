<?php

namespace Lalamove\Requests\V3;

use Carbon\Carbon;
use Lalamove\Resources\AbstractResource;

class Quotation
{
    const SPECIAL_REQUEST_COD = 'COD';
    const SPECIAL_REQUEST_HELP_BUY = 'HELP_BUY';
    const SPECIAL_REQUEST_BAG = 'LALABAG';

    const FLEET_PRIORITY_NONE = 'NONE';
    const FLEET_PRIORITY_FLEET_FIRST = 'FLEET_FIRST';

    /** @var string */
    public $scheduleAt;
    /** @var string */
    public $serviceType = 'MOTORCYCLE';
    /** @var array */
    public $specialRequests = [];
    /** @var string */
    public $language;
    /** @var array */
    public $stops = [];
    /** @var Item */
    public $item = Item::class;

    /**
     * Quotation constructor.
     * @param string $scheduleAt
     * @param string $language
     * @param array $stops
     * @param array $item
     * @param array $deliveries
     * @param string $serviceType
     * @param array $specialRequests
     * @param string $fleetPriority
     * @param string $promoCode
     * @return static
     */
    public static function make($scheduleAt, $language, $stops, $item, $serviceType = 'MOTORCYCLE', $specialRequests = [], $fleetPriority = 'NONE', $promoCode = '')
    {
        $instance = new static;
        $instance->set($scheduleAt, $language, $stops, $item, $serviceType, $specialRequests, $fleetPriority, $promoCode);
        return $instance;
    }

    /**
     * @param $scheduleAt
     * @param $language
     * @param $stops
     * @param $serviceType
     * @param $specialRequests
     * @param $fleetPriority
     * @param $promoCode
     */
    protected function set($scheduleAt, $language, $stops, $item, $serviceType, $specialRequests, $fleetPriority, $promoCode)
    {
        if ($scheduleAt instanceof Carbon) {
            $this->setScheduleAt($scheduleAt);
        } else {
            $this->scheduleAt = $scheduleAt;
        }

        $this->serviceType = $serviceType;
        $this->stops = $stops;
        $this->item = $item;
        $this->language = $language;
        $this->specialRequests = $specialRequests;
    }

    /**
     * @param Carbon $scheduleAt
     * @return string
     */
    public function setScheduleAt(Carbon $scheduleAt)
    {
        $this->scheduleAt = $scheduleAt->format(AbstractResource::LALAMOVE_TIME_FORMAT);
        return $this->scheduleAt;
    }

    /**
     * @param string|array $request
     */
    public function addSpecialRequest($request)
    {
        $this->specialRequests = array_merge($this->specialRequests, (array) $request);
    }

    /**
     * @param Stop|array $stop
     */
    public function addStop($stop)
    {
        $this->stops = array_merge($this->stops, (array) $stop);
    }

    /**
     * @param Item|array $item
     */
    public function setItem($item)
    {
        $this->item = $item;
    }
}
