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

    /** @var Location */
    public $location;

    /** @var string */
    public $placeId;

    /** @var array */
    public $addresses;

    /**
     * Stop constructor.
     * @param $location
     * @param string $placeId
     * @param array $addresses
     */
    public function __construct($location, $placeId = '', $addresses = [])
    {
        $this->location = $location;
        $this->placeId = $placeId;
        $this->addresses = $addresses;
    }

    /**
     * @param $location
     * @param string $placeId
     * @param array $addresses
     * @return static
     */
    public static function make($location, $placeId = '', $addresses = [])
    {
        return new static($location, $placeId, $addresses);
    }

    /**
     * @param string $locale
     * @param Address $address
     */
    public function addAddress($locale, $address)
    {
        $this->addresses[$locale] = $address;
    }
}
