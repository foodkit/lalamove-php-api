<?php

declare(strict_types=1);

namespace Lalamove\Requests\V2;

use Carbon\Carbon;
use Lalamove\Resources\AbstractResource;

class Quotation
{
    public const SPECIAL_REQUEST_COD = 'COD';
    public const SPECIAL_REQUEST_HELP_BUY = 'HELP_BUY';
    public const SPECIAL_REQUEST_BAG = 'LALABAG';

    public const FLEET_PRIORITY_NONE = 'NONE';
    public const FLEET_PRIORITY_FLEET_FIRST = 'FLEET_FIRST';

    /** @var Carbon|string $scheduledAt */
    public $scheduleAt = '';

    public string $serviceType = 'MOTORCYCLE';

    public array $specialRequests = [];

    public Contact $requesterContact;

    public array $stops = [];

    public array $deliveries = [];

    public string $fleetPriority = self::FLEET_PRIORITY_NONE;

    public string $promoCode = '';

    public static function make(string $scheduleAt, Contact $requesterContact, array $stops, array $deliveries, $serviceType = 'MOTORCYCLE', $specialRequests = [], $fleetPriority = 'NONE', $promoCode = ''): self
    {
        $instance = new static;
        $instance->set($scheduleAt, $requesterContact, $stops, $deliveries, $serviceType, $specialRequests, $fleetPriority, $promoCode);
        
        return $instance;
    }

    protected function set($scheduleAt, Contact $requesterContact, array $stops, array $deliveries, string $serviceType, array $specialRequests, string $fleetPriority, string $promoCode)
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

    public function setScheduleAt(Carbon $scheduleAt): string
    {
        $this->scheduleAt = $scheduleAt->format(AbstractResource::LALAMOVE_TIME_FORMAT);
        
        return $this->scheduleAt;
    }

    /**
     * @param $request string|array
     */
    public function addSpecialRequest($request): void
    {
        $this->specialRequests = array_merge($this->specialRequests, (array) $request);
    }

    /**
     * @param $stop Stop|array
     */
    public function addStop($stop): void
    {
        $this->stops = array_merge($this->stops, (array) $stop);
    }

    /**
     * @param $deliery Delivery|array
     * @return void
     */
    public function addDelivery($delivery): void
    {
        $this->deliveries = array_merge($this->deliveries, (array) $delivery);
    }
}
