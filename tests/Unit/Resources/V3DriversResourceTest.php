<?php

declare(strict_types=1);

namespace LalamoveTests\Unit\Resources;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Lalamove\Exceptions\PaymentRequiredException;
use LalamoveTests\BaseTest;
use LalamoveTests\Helpers\DummySettings;
use Lalamove\Http\GuzzleTransport;
use LalamoveTests\Mock\MockedExceptionThrowingTransport;

class V3DriversResourceTest extends BaseTest
{
    public function test_it_throws_client_exceptions()
    {
        $request = new Request('GET', '');
        $response = new Response(402, [], json_encode(['message' => 'You need to top up your account']));
        $ex = new ClientException('Invalid request', $request, $response);
        $transport = new MockedExceptionThrowingTransport($ex);

        $this->expectException(PaymentRequiredException::class);

        $resource = new \Lalamove\Resources\V3\DriversResource(new DummySettings(), $transport);
        $resource->get('order_id', 'driver_id');
    }

    public function test_it_should_get_driver_by_order_id_and_driver_id()
    {
        $client = $this->createClientMock('driver');

        $resource = new \Lalamove\Resources\V3\DriversResource(new DummySettings(), new GuzzleTransport($client));
        
        $response = $resource->get('order_id', 'driver_id');

        $this->assertObjectHasAttribute('driverId', $response);
        $this->assertObjectHasAttribute('name', $response);
        $this->assertObjectHasAttribute('phone', $response);
        $this->assertObjectHasAttribute('plateNumber', $response);
        $this->assertObjectHasAttribute('photo', $response);
        $this->assertObjectHasAttribute('coordinates', $response);
    }
}