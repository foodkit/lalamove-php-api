<?php

namespace Lalamove\Http;

class GuzzleTransport implements TransportInterface
{
    /**
     * @param LalamoveRequest $request
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send(LalamoveRequest $request)
    {
        $method = $request->getMethod();
        $uri = $request->getFullPath();
        $params = $request->getParams();
        $headers = $request->getHeaders();

        $payload = ['headers' => $headers];
        $payload[$method === 'GET' ? 'query' : 'json'] = $params;

        $response = $this->client()->request($method, $uri, $payload);

        $body = $response->getBody()->getContents();
        $result = json_decode($body);

        return $result;
    }

    /**
     * @return \GuzzleHttp\Client
     */
    protected function client()
    {
        return new \GuzzleHttp\Client();
    }
}