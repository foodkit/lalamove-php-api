<?php

declare(strict_types=1);

namespace Lalamove\Responses\V3;

class WebhookResponse
{
    public string $url;

    public function __construct($response = null)
    {
        $response = $response->data ?? null;

        if (!$response) {
            return null;
        }

        $this->url = $response->url;
    }
}