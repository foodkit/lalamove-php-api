<?php

namespace LalamoveTests\Integration;

use Lalamove\Requests\V3\Webhook;
use LalamoveTests\BaseTest;

class WebhookTest extends BaseTest
{
    public function test_it_should_create_webhook()
    {
        // refer to this docs https://developers.lalamove.com/files/webhook.pdf
        // this url is for testing only we can use our own endpoint later
        // make sure your endpoint returns 200 status
        $webhook = new Webhook('https://webhook.site/fd8ccc58-7447-4122-8a0c-f9c31eb79ad3');

        $response = $this->getClient()->webhooks()->create($webhook);

        $this->assertObjectHasAttribute('url', $response);
    }
}