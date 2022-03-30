<?php

declare(strict_types=1);

namespace LalamoveTests\Unit\Resources;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Lalamove\Exceptions\PaymentRequiredException;
use Lalamove\Http\GuzzleTransport;
use Lalamove\Http\LalamoveRequest;
use Lalamove\Http\TransportInterface;
use Lalamove\Requests\V3\Contact;
use Lalamove\Requests\V3\Order;
use LalamoveTests\BaseTest;
use LalamoveTests\Helpers\DummySettings;
use LalamoveTests\Mock\MockedExceptionThrowingTransport;

class V3OrdersResourceTest extends BaseTest
{
    public function test_it_throws_client_exceptions()
    {
        $request = new Request('GET', '');
        $response = new Response(402, [], json_encode(['message' => 'You need to top up your account']));
        $ex = new ClientException('Invalid request', $request, $response);
        $transport = new MockedExceptionThrowingTransport($ex);

        $this->expectException(PaymentRequiredException::class);

        $resource = new \Lalamove\Resources\V3\OrdersResource(new DummySettings(), $transport);
        $response = $resource->details('any_order_id');
    }

    public function test_it_should_create_order()
    {
        $client = $this->createClientMock('orders');

        $resource = new \Lalamove\Resources\V3\OrdersResource(new DummySettings(), new GuzzleTransport($client));
        
        $response = $resource->create(new Order('quotationId', new Contact('', ''), []));

        $this->assertObjectHasAttribute('orderId', $response);
        $this->assertObjectHasAttribute('quotationId', $response);
        $this->assertObjectHasAttribute('priceBreakdown', $response);
        $this->assertObjectHasAttribute('driverId', $response);
        $this->assertObjectHasAttribute('shareLink', $response);
        $this->assertObjectHasAttribute('status', $response);
        $this->assertObjectHasAttribute('distance', $response);
        $this->assertObjectHasAttribute('stops', $response);
    }

    public function test_it_should_get_order_details_id()
    {
        $client = $this->createClientMock('orders');

        $resource = new \Lalamove\Resources\V3\OrdersResource(new DummySettings(), new GuzzleTransport($client));
        
        $response = $resource->details('any_order_id');

        $this->assertObjectHasAttribute('orderId', $response);
        $this->assertObjectHasAttribute('quotationId', $response);
        $this->assertObjectHasAttribute('priceBreakdown', $response);
        $this->assertObjectHasAttribute('driverId', $response);
        $this->assertObjectHasAttribute('shareLink', $response);
        $this->assertObjectHasAttribute('status', $response);
        $this->assertObjectHasAttribute('distance', $response);
        $this->assertObjectHasAttribute('stops', $response);
    }

    public function test_it_should_cancel_order()
    {
        $client = $this->createClientMock('orders');

        $resource = new \Lalamove\Resources\V3\OrdersResource(new DummySettings(), new GuzzleTransport($client));
        
        $response = $resource->cancel('any_order_id'); // cancel return boolean

        $this->assertEquals(true, $response);
    }
}

