<?php

declare(strict_types=1);

namespace LalamoveTests\Unit\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\TransferException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Lalamove\Http\GuzzleTransport;
use Lalamove\Http\LalamoveRequest;
use LalamoveTests\BaseTest;
use LalamoveTests\Helpers\DummySettings;
use Psr\Log\LoggerInterface;

class GuzzleTransportTest extends BaseTest
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

    public function test_lalamove_request_response_is_logged_correctly()
    {
        // Make a request
        $request = $this->makeRequest('GET', 'v2/orders', []);

        // Mock guzzle client (no real http is done)
        $mockHandler      = new MockHandler([
            new Response(200, ['ResponseHeader1' => 'KnownValue'], "someBodyPayload"),
        ]);
        $handler          = HandlerStack::create($mockHandler);
        $fakeGuzzleClient = new Client(['handler' => $handler]);


        // Mock a logger
        $mock = $this->createMock(LoggerInterface::class);
        $mock->expects($this->once())->method('info')->with($this->callback(function ($subject) use ($request) {

            $loggedRequestLooksOkay =
                preg_match("#^" . $request->getMethod() . "#", $subject) &&
                preg_match("#" . $request->getUri() . "#", $subject);

            $loggedResponseLooksOkay =
                preg_match("#ResponseHeader1: KnownValue#", $subject) &&
                preg_match("#someBodyPayload#", $subject);

            return $loggedRequestLooksOkay && $loggedResponseLooksOkay;
        }));
        $this->settings->logger = $mock;

        // Send request
        $transport = new GuzzleTransport($fakeGuzzleClient);
        $transport->send($request);
    }

    public function test_lalamove_request_response_is_logged_correctly_when_network_exception_thrown()
    {
        // Make a request
        $request = $this->makeRequest('GET', 'v2/orders', []);

        // Mock guzzle client (no real http is done)
        $fakeGuzzleClient = $this->createMock(Client::class);
        $fakeGuzzleClient
            ->expects($this->once())
            ->method('request')
            ->willThrowException(new TransferException("network is unavailable"));

        // Mock a logger
        $mock = $this->createMock(LoggerInterface::class);
        $mock->expects($this->once())->method('info')->with($this->callback(function ($subject) use ($request) {

            $loggedRequestLooksOkay =
                preg_match("#^" . $request->getMethod() . "#", $subject) &&
                preg_match("#" . $request->getUri() . "#", $subject);

            $loggedResponseLooksOkay =
                preg_match("#network is unavailable#", $subject);

            return $loggedRequestLooksOkay && $loggedResponseLooksOkay;
        }));
        $this->settings->logger = $mock;

        // Send request
        $transport = new GuzzleTransport($fakeGuzzleClient);
        try {
            $transport->send($request);
        } catch (\Throwable $e) {
            // do nothing here, exception is expected
        }
    }

    public function test_lalamove_v3_request_response_is_logged_correctly_when_network_exception_thrown()
    {
        // Make a request
        $request = $this->makeRequest('GET', 'v3/orders', []);

        // Mock guzzle client (no real http is done)
        $fakeGuzzleClient = $this->createMock(Client::class);
        $fakeGuzzleClient
            ->expects($this->once())
            ->method('request')
            ->willThrowException(new TransferException("network is unavailable"));

        // Mock a logger
        $mock = $this->createMock(LoggerInterface::class);
        $mock->expects($this->once())->method('info')->with($this->callback(function ($subject) use ($request) {

            $loggedRequestLooksOkay =
                preg_match("#^" . $request->getMethod() . "#", $subject) &&
                preg_match("#" . $request->getUri() . "#", $subject);

            $loggedResponseLooksOkay =
                preg_match("#network is unavailable#", $subject);

            return $loggedRequestLooksOkay && $loggedResponseLooksOkay;
        }));
        $this->settings->logger = $mock;

        // Send request
        $transport = new GuzzleTransport($fakeGuzzleClient);
        try {
            $transport->send($request);
        } catch (\Throwable $e) {
            // do nothing here, exception is expected
        }
    }

    public function test_lalamove_v3_request_response_is_logged_correctly()
    {
        // Make a request
        $request = $this->makeRequest('GET', 'v3/orders', []);

        // Mock guzzle client (no real http is done)
        $mockHandler      = new MockHandler([
            new Response(200, ['ResponseHeader1' => 'KnownValue'], "someBodyPayload"),
        ]);
        $handler          = HandlerStack::create($mockHandler);
        $fakeGuzzleClient = new Client(['handler' => $handler]);


        // Mock a logger
        $mock = $this->createMock(LoggerInterface::class);
        $mock->expects($this->once())->method('info')->with($this->callback(function ($subject) use ($request) {

            $loggedRequestLooksOkay =
                preg_match("#^" . $request->getMethod() . "#", $subject) &&
                preg_match("#" . $request->getUri() . "#", $subject);

            $loggedResponseLooksOkay =
                preg_match("#ResponseHeader1: KnownValue#", $subject) &&
                preg_match("#someBodyPayload#", $subject);

            return $loggedRequestLooksOkay && $loggedResponseLooksOkay;
        }));
        $this->settings->logger = $mock;

        // Send request
        $transport = new GuzzleTransport($fakeGuzzleClient);
        $transport->send($request);
    }

    protected function makeRequest(string $method, string $endpoint, array $params): LalamoveRequest
    {
        return new LalamoveRequest($this->settings, $method, $endpoint, $params, $this->uuid, $this->clock);
    }
}