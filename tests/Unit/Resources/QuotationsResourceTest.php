<?php

declare(strict_types=1);

namespace LalamoveTests\Unit\Resources;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Lalamove\Exceptions\UnauthorizedException;
use Lalamove\Requests\V2\Quotation;
use LalamoveTests\BaseTest;
use LalamoveTests\Helpers\DummySettings;
use LalamoveTests\Mock\MockedExceptionThrowingTransport;

class QuotationsResourceTest extends BaseTest
{
    public function test_it_throws_client_exceptions()
    {
        $request = new Request('GET', '');
        $response = new Response(401, [], json_encode(['message' => 'You need to top up your account']));
        $ex = new ClientException('Invalid request', $request, $response);
        $transport = new MockedExceptionThrowingTransport($ex);

        $this->expectException(UnauthorizedException::class);
        $resource = new \Lalamove\Resources\V2\QuotationsResource(new DummySettings(), $transport);
        $resource->create(new Quotation());
    }
}