<?php

declare(strict_types=1);

namespace LalamoveTests\Unit\Resources;

use LalamoveTests\BaseTest;
use LalamoveTests\Helpers\DummySettings;
use Lalamove\Http\GuzzleTransport;
use Lalamove\Requests\V3\Webhook;

class V3WebhookResourceTest extends BaseTest
{
    public function test_it_should_create_webhook()
    {
        $client = $this->createClientMock('webhook');

        $resource = new \Lalamove\Resources\V3\WebhookResource(new DummySettings(), new GuzzleTransport($client));
        
        $response = $resource->create(new Webhook('YOUR_WEBHOOK_URI'));

        $this->assertObjectHasAttribute('url', $response);
    }
}