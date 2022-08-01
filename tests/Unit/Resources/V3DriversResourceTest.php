<?php

declare(strict_types=1);

namespace LalamoveTests\Unit\Resources;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Lalamove\Exceptions\PaymentRequiredException;
use Lalamove\Responses\V3\DriverResponse;
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

    public function test_it_parses_missing_coordinates()
    {
        $resource = new DriverResponse((object)[
            'data' => (object) [
                'driverId' => '000001',
                'name' => '[_]FIRST LAST',
                'phone' => '+66000000000, ',
                'photo' => 'https://sg-upload-appweb.lalamove.com/showhead.php?image_type=5&image_hash=fake_hash_here&driver_id=000001, ',
                'plateNumber' => '**1234*',
            ],
        ]);
        self::assertInstanceOf(DriverResponse::class, $resource);
        self::assertEquals('', $resource->coordinates->lat);
        self::assertEquals('', $resource->coordinates->lng);
    }
}