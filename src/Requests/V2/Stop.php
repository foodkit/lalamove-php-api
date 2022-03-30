<?php

namespace Lalamove\Requests\V2;

class Stop
{
    const LOCALE_HK_EN = 'en_HK';
    const LOCALE_HK_ZH = 'zh_HK';
    const LOCALE_TW_ZH = 'zh_TW';
    const LOCALE_SG_EN = 'en_SG';
    const LOCALE_TH_TH = 'th_TH';
    const LOCALE_TH_EN = 'en_TH';
    const LOCALE_PH_EN = 'en_PH';

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

    public static function make(Location $location, $placeId = '', $addresses = []): static
    {
        return new static($location, $placeId, $addresses);
    }

    public function addAddress(string $locale, Address $address)
    {
        $this->addresses[$locale] = $address;
    }
}
