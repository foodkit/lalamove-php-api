<?php

declare(strict_types=1);

namespace LalamoveTests\Unit\Http;

use Lalamove\Http\LalamoveRequest;
use LalamoveTests\BaseTest;
use LalamoveTests\Helpers\DummySettings;

class V3LalamoveRequestTest extends BaseTest
{
    protected $settings;
    protected MockedUuidGenerator $uuid;
    protected MockedClock $clock;

    public function setUp(): void
    {
        $this->settings = new DummySettings();
        $this->uuid     = new MockedUuidGenerator();
        $this->clock    = new MockedClock();
    }

    public function test_it_generates_authorization_header()
    {
        $request = $this->makeRequest('GET', 'v3/orders', []);
        $headers = $request->getHeaders();
        $this->assertArrayHasKey('Authorization', $headers);
    }

    public function test_authorization_header_is_correctly_formatted()
    {
        $request = $this->makeRequest('GET', 'v3/orders', []);
        $authorization = $request->getHeaders()['Authorization'];
        $parts = explode(':', $authorization);
        $this->assertCount(3, $parts);
    }

    public function test_content_type_headers_are_present()
    {
        $request = $this->makeRequest('GET', 'v3/orders', []);
        $headers = $request->getHeaders();
        $this->assertArrayHasKey('Accept', $headers);
        $this->assertArrayHasKey('Content-type', $headers);
    }

    public function test_lalamove_headers_are_present()
    {
        $request = $this->makeRequest('GET', 'v3/orders', []);
        $headers = $request->getHeaders();
        $this->assertArrayHasKey('X-LLM-Country', $headers);
        $this->assertArrayHasKey('X-Request_ID', $headers);
    }

    public function test_it_generates_authorization_header_v3()
    {
        $request = $this->makeRequest('GET', 'v3/orders', []);
        $headers = $request->getHeaders();
        $this->assertArrayHasKey('Authorization', $headers);
    }

    public function test_authorization_header_is_correctly_formatted_v3()
    {
        $request = $this->makeRequest('GET', 'v3/orders', []);
        $authorization = $request->getHeaders()['Authorization'];
        $parts = explode(':', $authorization);
        $this->assertCount(3, $parts);
    }

    public function test_content_type_headers_are_present_v3()
    {
        $request = $this->makeRequest('GET', 'v3/orders', []);
        $headers = $request->getHeaders();
        $this->assertArrayHasKey('Accept', $headers);
        $this->assertArrayHasKey('Content-type', $headers);
    }

    public function test_lalamove_headers_are_present_v3()
    {
        $request = $this->makeRequest('GET', 'v3/orders', []);
        $headers = $request->getHeaders();
        $this->assertArrayHasKey('X-LLM-Country', $headers);
        $this->assertArrayHasKey('X-Request_ID', $headers);
    }

    protected function makeRequest($method, $endpoint, $params): LalamoveRequest
    {
        return new LalamoveRequest($this->settings, $method, $endpoint, $params, $this->uuid, $this->clock);
    }
}