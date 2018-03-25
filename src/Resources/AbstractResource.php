<?php

namespace Lalamove\Resources;

use Lalamove\Http\GuzzleTransport;
use Lalamove\Http\LalamoveRequest;

abstract class AbstractResource
{
    const LALAMOVE_TIME_FORMAT = 'Y-m-d\TH:i:00.000\Z';
    const LALAMOVE_API_VERSION = '2';

    protected $endpoint;
    protected $settings;

    public function __construct($settings, $transport = null)
    {
        $this->transport = $transport ? $transport : new GuzzleTransport();
        $this->settings = $settings;
    }

    /**
     * @param string $relative
     * @return string
     */
    protected function uri($relative = '')
    {
        $version = self::LALAMOVE_API_VERSION;
        return "/v{$version}/{$relative}";
    }

    /**
     * @param $method
     * @param $uri
     * @param $params
     * @return mixed
     */
    protected function send($method, $uri, $params = [])
    {
        $request = new LalamoveRequest($this->settings, $method, $uri, $params);
        
        try {
            return $this->transport->send($request);
        } catch (\Exception $ex) {

        }
    }

    /**
     * @return \GuzzleHttp\Client
     */
    protected function client()
    {
        return new \GuzzleHttp\Client();
    }
}
