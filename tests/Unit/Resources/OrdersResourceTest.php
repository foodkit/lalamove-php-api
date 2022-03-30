<?php

declare(strict_types=1);

namespace LalamoveTests\Unit\Resources;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Lalamove\Exceptions\PaymentRequiredException;
use LalamoveTests\BaseTest;
use LalamoveTests\Helpers\DummySettings;
use LalamoveTests\Mock\MockedExceptionThrowingTransport;

class OrdersResourceTest extends BaseTest
{
    public function test_it_throws_client_exceptions()
    {
        $request = new Request('GET', '');
        $response = new Response(402, [], json_encode(['message' => 'You need to top up your account']));
        $ex = new ClientException('Invalid request', $request, $response);
        $transport = new MockedExceptionThrowingTransport($ex);

        $this->expectException(PaymentRequiredException::class);
        $resource = new \Lalamove\Resources\V2\OrdersResource(new DummySettings(), $transport);
        $resource->details('doesn\'t matter what this is');
    }
}
