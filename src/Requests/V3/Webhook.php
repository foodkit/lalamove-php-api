<?php

declare(strict_types=1);

namespace Lalamove\Requests\V3;

class Webhook
{
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