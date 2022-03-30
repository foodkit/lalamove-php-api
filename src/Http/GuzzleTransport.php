<?php

declare(strict_types=1);

namespace Lalamove\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\TransferException;
use GuzzleHttp\Psr7\Message;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use stdClass;

class GuzzleTransport implements TransportInterface
{
    private Client $client;

    public function __construct(Client $client = null)
    {
        $this->client = $client ?? new Client();
    }

    public function send(LalamoveRequest $request): ?stdClass
    {
        $method  = $request->getMethod();
        $uri     = $request->getFullPath();
        $params  = $request->getParams();
        $headers = $request->getHeaders();

        $payload = ['headers' => $headers];

        $payload[$method === 'GET' ? 'query' : 'json'] = $params;

        try {
            $response = $this->client->request($method, $uri, $payload);
            $this->logRequestResponse($request, $response);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $this->logRequestResponse($request, $e->getResponse());
            } else {
                $this->logRequestFailure($request, $e->getMessage());
            }
            throw $e;
        } catch (TransferException $e) {
            $this->logRequestFailure($request, $e->getMessage());
            throw $e;
        }

        $body   = $response->getBody()->getContents();
        $result = json_decode($body);

        return $result;
    }


    /**
     * Log request/response details
     * @see https://github.com/guzzle/psr7#function-str
     */
    protected function logRequestResponse(LalamoveRequest $request, Response $httpResponse): void
    {
        if (!$request->getSettings()->logger) {
            return;
        }

        $httpRequest = $this->convertRequest($request);
        $message = Message::toString($httpRequest);
        $message .= PHP_EOL;
        $message .= Message::toString($httpResponse);

        // Need to do this after reading the body of the response, or it will end up being empty when we use it later:
        $httpResponse->getBody()->rewind();

        $request->getSettings()->logger->info($message);
    }

    /**
     * Log request which failed before connecting to the server
     */
    protected function logRequestFailure(LalamoveRequest $request, string $failureMessage)
    {
        if (!$request->getSettings()->logger) {
            return;
        }

        $httpRequest = $this->convertRequest($request);
        $message = Message::toString($httpRequest);
        $message .= PHP_EOL;
        $message .= $failureMessage;

        $request->getSettings()->logger->info($message);
    }

    /**
     * Helper method to convert a domain LalamoveRequest to the guzzle's one
     */
    protected function convertRequest(LalamoveRequest $request): Request
    {
        $uri  = $request->getFullPath();
        $body = "";

        if ($request->getMethod() == "GET") {
            $uri .= "?" . http_build_query($request->getParams());
        } else {
            $body = json_encode($request->getParams());
        }

        return new Request($request->getMethod(), $uri, $request->getHeaders(), $body);
    }
}