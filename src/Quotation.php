<?php

namespace Lalamove;

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
    /** @var Contact */
    public $requesterContact;
    /** @var array */
    public $stops = [];
    /** @var array */
    public $deliveries = [];
    /** @var string */
    public $fleetPriority = self::FLEET_PRIORITY_NONE;
    /** @var string */
    public $promoCode = '';

    /**
     * Quotation constructor.
     * @param string $scheduleAt
     * @param Contact $requesterContact
     * @param array $stops
     * @param array $deliveries
     * @param string $serviceType
     * @param array $specialRequests
     * @param string $fleetPriority
     * @param string $promoCode
     * @return static
     */
    public static function make($scheduleAt, $requesterContact, $stops, $deliveries, $serviceType = 'MOTORCYCLE', $specialRequests = [], $fleetPriority = 'NONE', $promoCode = '')
    {
        $instance = new static;
        if ($scheduleAt instanceof Carbon) {
            $instance->setScheduleAt($scheduleAt);
        } else {
            $instance->scheduleAt = $scheduleAt;
        }

        $instance->serviceType = $serviceType;
        $instance->requesterContact = $requesterContact;
        $instance->stops = $stops;
        $instance->deliveries = $deliveries;
        $instance->specialRequests = $specialRequests;
        $instance->fleetPriority = $fleetPriority;
        $instance->promoCode = $promoCode;
        return $instance;
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
     * @param Delivery|array $delivery
     */
    public function addDelivery($delivery)
    {
        $this->deliveries = array_merge($this->deliveries, (array) $delivery);
    }
}
