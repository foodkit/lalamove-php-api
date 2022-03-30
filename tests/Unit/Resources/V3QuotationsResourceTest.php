<?php

declare(strict_types=1);

namespace LalamoveTests\Unit\Resources;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Lalamove\Exceptions\PaymentRequiredException;
use Lalamove\Requests\V3\Quotation;
use LalamoveTests\BaseTest;
use LalamoveTests\Helpers\DummySettings;

use Lalamove\Http\GuzzleTransport;
use LalamoveTests\Mock\MockedExceptionThrowingTransport;

class V3QuotationsResourceTest extends BaseTest
{
    public function test_it_throws_client_exceptions()
    {
        $request = new Request('GET', '');
        $response = new Response(402, [], json_encode(['message' => 'You need to top up your account']));
        $ex = new ClientException('Invalid request', $request, $response);
        $transport = new MockedExceptionThrowingTransport($ex);

        $this->expectException(PaymentRequiredException::class);

        $resource = new \Lalamove\Resources\V3\QuotationsResource(new DummySettings(), $transport);
        $resource = $resource->create(new Quotation());
    }

    public function test_it_should_create_quotation()
    {
        $client = $this->createClientMock('quotations');

        $resource = new \Lalamove\Resources\V3\QuotationsResource(new DummySettings(), new GuzzleTransport($client));
        
        $response = $resource->create(new Quotation());

        $this->assertObjectHasAttribute('quotationId', $response);
        $this->assertObjectHasAttribute('scheduleAt', $response);
        $this->assertObjectHasAttribute('expiresAt', $response);
        $this->assertObjectHasAttribute('serviceType', $response);
        $this->assertObjectHasAttribute('language', $response);
        $this->assertObjectHasAttribute('specialRequests', $response);
        $this->assertObjectHasAttribute('stops', $response);
        $this->assertObjectHasAttribute('isRouteOptimized', $response);
        $this->assertObjectHasAttribute('priceBreakdown', $response);
        $this->assertObjectHasAttribute('item', $response);
    }

    public function test_it_should_get_quotation_by_id()
    {
        $client = $this->createClientMock('quotations');

        $resource = new \Lalamove\Resources\V3\QuotationsResource(new DummySettings(), new GuzzleTransport($client));
        
        $response = $resource->get('any_quotation_id');

        $this->assertObjectHasAttribute('quotationId', $response);
        $this->assertObjectHasAttribute('scheduleAt', $response);
        $this->assertObjectHasAttribute('expiresAt', $response);
        $this->assertObjectHasAttribute('serviceType', $response);
        $this->assertObjectHasAttribute('language', $response);
        $this->assertObjectHasAttribute('specialRequests', $response);
        $this->assertObjectHasAttribute('stops', $response);
        $this->assertObjectHasAttribute('isRouteOptimized', $response);
        $this->assertObjectHasAttribute('priceBreakdown', $response);
        $this->assertObjectHasAttribute('item', $response);
    }
}