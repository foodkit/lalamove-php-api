<?php

declare(strict_types=1);

namespace Lalamove\Requests\V3;

use Carbon\Carbon;
use Lalamove\Resources\AbstractResource;

class Quotation
{
    public const SPECIAL_REQUEST_COD = 'COD';
    public const SPECIAL_REQUEST_HELP_BUY = 'HELP_BUY';
    public const SPECIAL_REQUEST_BAG = 'LALABAG';

    public const FLEET_PRIORITY_NONE = 'NONE';
    public const FLEET_PRIORITY_FLEET_FIRST = 'FLEET_FIRST';

    /** @var Carbon|string */
    public $scheduleAt = '';

    public string $serviceType = 'MOTORCYCLE';

    public array $specialRequests = [];

    public string $language;

    /** @var Stop[] */
    public array $stops = [];
    
    public Item $item;

    public static function make($scheduleAt, string $language, array $stops, Item $item, $serviceType = 'MOTORCYCLE', $specialRequests = []): self
    {
        $instance = new static;
        $instance->set($scheduleAt, $language, $stops, $item, $serviceType, $specialRequests);
        
        return $instance;
    }

    protected function set($scheduleAt, string $language, array $stops, Item $item, string $serviceType, array $specialRequests)
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

    /**
     * @param $request array|string
     * @return void
     */
    public function addSpecialRequest($request): void
    {
        $this->specialRequests = array_merge($this->specialRequests, (array) $request);
    }

    /**
     * @param Stop|array $stop
     * @return void
     */
    public function addStop($stop): void
    {
        $this->stops = array_merge($this->stops, (array) $stop);
    }

    /**
     * @param Item|array $item
     * @return void
     */
    public function setItem($item)
    {
        $this->item = $item;
    }
}
