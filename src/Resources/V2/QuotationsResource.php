<?php

namespace Lalamove\Resources\V2;

use Lalamove\Requests\V2\Quotation;
use Lalamove\Resources\AbstractResource;
use Lalamove\Responses\V2\QuotationResponse;

class QuotationsResource extends AbstractResource
{
    /**
     * @param \Lalamove\Requests\V2\Quotation $quotation
     * @return \Lalamove\Responses\V2\QuotationResponse
     * @throws \Lalamove\Exceptions\LalamoveException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(Quotation $quotation)
    {
        $response = $this->send('POST', 'quotations', $quotation);
        return new QuotationResponse($response);
    }
}