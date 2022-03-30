<?php

declare(strict_types=1);

namespace Lalamove\Resources;

use GuzzleHttp\Exception\RequestException;
use Lalamove\Exceptions\ConflictException;
use Lalamove\Exceptions\ForbiddenException;
use Lalamove\Exceptions\InvalidRequestException;
use Lalamove\Exceptions\LalamoveException;
use Lalamove\Exceptions\NotFoundException;
use Lalamove\Exceptions\PaymentRequiredException;
use Lalamove\Exceptions\ServerException;
use Lalamove\Exceptions\TooManyRequestsException;
use Lalamove\Exceptions\UnauthorizedException;
use Lalamove\Http\GuzzleTransport;
use Lalamove\Http\LalamoveRequest;
use Lalamove\Http\TransportInterface;
use stdClass;

abstract class AbstractResource
{
    public const LALAMOVE_TIME_FORMAT = 'Y-m-d\TH:i:00.000\Z';

    protected TransportInterface $transport;

    protected $settings;

    public function __construct($settings, TransportInterface $transport = null)
    {
        $this->settings = $settings;
        $this->transport = $transport ?: new GuzzleTransport();
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \GuzzleHttp\Exception\ClientException
     * @throws \GuzzleHttp\Exception\ServerException
     */
    protected function send(string $method, string $uri, $params = []): ?stdClass
    {
        $request = new LalamoveRequest($this->settings, $method, $uri, $params);

        try {
            return $this->transport->send($request);

        } catch (\GuzzleHttp\Exception\ClientException $ex) {
            if ($mapped = $this->mapClientException($ex)) {
                throw $mapped;
            } else {
                throw $ex;
            }

        } catch (\GuzzleHttp\Exception\ServerException $ex) {
            throw new ServerException($ex->getMessage(), $ex->getCode(), $ex);
        }
    }

    protected function mapClientException(RequestException $baseException): ?LalamoveException
    {
        $typedExceptions = [
            // Client exceptions
            ConflictException::class,
            ForbiddenException::class,
            InvalidRequestException::class,
            NotFoundException::class,
            PaymentRequiredException::class,
            TooManyRequestsException::class,
            UnauthorizedException::class,
            // Server exceptions
            ServerException::class,
        ];

        $message = json_decode("{$baseException->getResponse()->getBody()}");
        $message = isset($message->detail) ? $message->detail : null;

        foreach ($typedExceptions as $cExName) {
            /** @var \Lalamove\Exceptions\LalamoveException $cEx */
            $cEx = new $cExName($message ? $message : $baseException->getMessage(), $baseException->getCode(), $baseException);

            $response = $baseException->getResponse();

            if ($response && $response->getStatusCode() == $cEx->getStatusCode()) {
                return $cEx;
            }
        }

        return null;
    }
}
