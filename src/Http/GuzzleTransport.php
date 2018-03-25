<?php

namespace Lalamove\Http;

class GuzzleTransport implements TransportInterface
{
    /**
     * @param LalamoveRequest $request
     * @return mixed
     */
    public function send(LalamoveRequest $request)
    {
        $method = $request->getMethod();
        $endpoint = $request->getFullPath();
        $uri = $request->getUri();
        $params = $request->getParams();
        $headers = $request->getHeaders();

        $payload = ['headers' => $headers];
        $payload[$method === 'GET' ? 'query' : 'json'] = $params;

        $response = $this->client()->request($method, $endpoint . $uri, $payload);

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