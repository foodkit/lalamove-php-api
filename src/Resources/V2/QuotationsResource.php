<?php

namespace Lalamove\Resources\V2;

use Lalamove\Quotation;
use Lalamove\Resources\AbstractResource;
use Lalamove\Responses\QuotationResponse;

class QuotationsResource extends AbstractResource
{
    /**
     * @param Quotation $quotation
     * @return QuotationResponse
     * @throws \Lalamove\Exceptions\LalamoveException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(Quotation $quotation)
    {
        $response = $this->send('POST', 'quotations', $quotation);
        return new QuotationResponse($response);
    }
}