<?php

declare(strict_types=1);

namespace Lalamove\Requests\V2;

class Stop
{
    public const LOCALE_HK_EN = 'en_HK';
    public const LOCALE_HK_ZH = 'zh_HK';
    public const LOCALE_TW_ZH = 'zh_TW';
    public const LOCALE_SG_EN = 'en_SG';
    public const LOCALE_TH_TH = 'th_TH';
    public const LOCALE_TH_EN = 'en_TH';
    public const LOCALE_PH_EN = 'en_PH';

    public Location $location;

    public string $placeId;

    /** @var Address[] */
    public array $addresses;

    /**
     * Stop constructor.
     */
    public function __construct(Location $location, $placeId = '', $addresses = [])
    {
        $this->location  = $location;
        $this->placeId   = $placeId;
        $this->addresses = $addresses;
    }

    public static function make(Location $location, $placeId = '', $addresses = []): self
    {
        return new static($location, $placeId, $addresses);
    }

    public function addAddress(string $locale, Address $address)
    {
        $this->addresses[$locale] = $address;
    }
}
