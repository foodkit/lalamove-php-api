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

    public Carbon|string $scheduleAt = '';

    public string $serviceType = 'MOTORCYCLE';

    public array $specialRequests = [];

    public string $language;

    /** @var Stop[] */
    public array $stops = [];
    
    public Item $item;

    /**
     * Quotation constructor.
     */
    public static function make(Carbon|string $scheduleAt, string $language, array $stops, Item $item, $serviceType = 'MOTORCYCLE', $specialRequests = []): static
    {
        $instance = new static;
        $instance->set($scheduleAt, $language, $stops, $item, $serviceType, $specialRequests);
        
        return $instance;
    }

    protected function set(Carbon|string $scheduleAt, string $language, array $stops, Item $item, string $serviceType, array $specialRequests,)
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

    public function setScheduleAt(Carbon $scheduleAt): string
    {
        $this->scheduleAt = $scheduleAt->format(AbstractResource::LALAMOVE_TIME_FORMAT);
     
        return $this->scheduleAt;
    }

    public function addSpecialRequest(array|string $request): void
    {
        $this->specialRequests = array_merge($this->specialRequests, (array) $request);
    }

    public function addStop(Stop|array $stop): void
    {
        $this->stops = array_merge($this->stops, (array) $stop);
    }

    public function setItem(Item|array $item)
    {
        $this->item = $item;
    }
}
