<?php

namespace Lalamove\Responses\V3;

class WebhookResponse
{
    public string $url;

    /**
     * Pass in the deserialized JSON response to populate all relevant fields.
     * @param object $response
     */
    public function __construct($response = null)
    {
        $response = $response->data ?? null;

        if (!$response) {
            return null;
        }

        $this->url = $response->url;
    }
}