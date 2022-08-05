<?php

declare(strict_types=1);

namespace LalamoveTests\Unit\Resources;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Lalamove\Exceptions\PaymentRequiredException;
use Lalamove\Requests\V3\Quotation;
use Lalamove\Responses\V3\QuotationResponse;
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

    public function test_it_maps_response()
    {
        // Sample payload from: https://developers.lalamove.com/#get-quotation
        $sampleResponse = "{
    \"data\": {
        \"quotationId\": \"1514140994227007571\",
        \"scheduleAt\": \"2022-04-13T07:18:38.00Z\",
        \"expiresAt\": \"2022-04-13T07:23:39.00Z\",
        \"serviceType\": \"MOTORCYCLE\",
        \"specialRequests\": [
            \"TOLL_FEE_10\",
            \"PURCHASE_SERVICE_1\"
        ],
        \"language\": \"EN_HK\",
        \"stops\": [
            {
                \"stopId\": \"1514140995971838016\",
                \"coordinates\": {
                    \"lat\": \"22.3354735\",
                    \"lng\": \"114.1761581\"
                },
                \"address\": \"Innocentre, 72 Tat Chee Ave, Kowloon Tong\"
            },
            {
                \"stopId\": \"1514140995971838017\",
                \"coordinates\": {
                    \"lat\": \"22.2812946\",
                    \"lng\": \"114.1598610\"
                },
                \"address\": \"Statue Square, Des Voeux Rd Central, Central\"
            }
        ],
        \"isRouteOptimized\": false,
        \"priceBreakdown\": {
            \"base\": \"90\",
            \"specialRequests\": \"13\",
            \"vat\": \"21\",
            \"totalBeforeOptimization\": \"124\",
            \"totalExcludePriorityFee\": \"124\",
            \"total\": \"124\",
            \"currency\": \"HKD\"
        }
    }
}";
        $json = json_decode($sampleResponse);
        $quotation = new QuotationResponse($json);
        self::assertInstanceOf(QuotationResponse::class, $quotation);
    }
}