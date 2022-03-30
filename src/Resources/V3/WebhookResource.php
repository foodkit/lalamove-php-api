<?php

declare(strict_types=1);

namespace Lalamove\Resources\V3;

use Lalamove\Requests\V3\Webhook;
use Lalamove\Resources\AbstractResource;
use Lalamove\Responses\V3\WebhookResponse;

class WebhookResource extends AbstractResource
{
    public function create(Webhook $webhook): WebhookResponse
    {
        $response = $this->send('PATCH', 'webhook', $webhook);

        return new WebhookResponse($response);
    }
}