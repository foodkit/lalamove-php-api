<?php

namespace Lalamove\Requests\V2;

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
        $instance->set($scheduleAt, $requesterContact, $stops, $deliveries, $serviceType, $specialRequests, $fleetPriority, $promoCode);
        return $instance;
    }

    /**
     * @param $scheduleAt
     * @param $requesterContact
     * @param $stops
     * @param $deliveries
     * @param $serviceType
     * @param $specialRequests
     * @param $fleetPriority
     * @param $promoCode
     */
    protected function set($scheduleAt, $requesterContact, $stops, $deliveries, $serviceType, $specialRequests, $fleetPriority, $promoCode)
    {
        if ($scheduleAt instanceof Carbon) {
            $this->setScheduleAt($scheduleAt);
        } else {
            $this->scheduleAt = $scheduleAt;
        }

        $this->serviceType = $serviceType;
        $this->requesterContact = $requesterContact;
        $this->stops = $stops;
        $this->deliveries = $deliveries;
        $this->specialRequests = $specialRequests;
        $this->fleetPriority = $fleetPriority;
        $this->promoCode = $promoCode;
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
