<?php

declare(strict_types=1);

namespace Lalamove\Requests\V3;

class Webhook
{
    public const ASSIGNING_DRIVER = 'ASSIGNING_DRIVER';
    
    public const ON_GOING = 'ON_GOING';
    
    public const PICKED_UP = 'PICKED_UP';
    
    public const COMPLETED = 'COMPLETED';
    
    public const CANCELLED = 'CANCELED';

    public const REJECTED = 'REJECTED';

    public string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public static function make(string $url)
    {
        return new static($url);
    }
}