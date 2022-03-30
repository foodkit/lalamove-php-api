<?php

namespace Lalamove\Requests\V3;

class Webhook
{
    public string $url;

    /**
     * Address constructor.
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public static function make(string $url)
    {
        return new static($url);
    }
}