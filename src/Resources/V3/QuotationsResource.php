<?php

declare(strict_types=1);

namespace Lalamove\Resources\V3;

use Lalamove\Requests\V3\Quotation;
use Lalamove\Responses\V3\QuotationResponse;
use Lalamove\Resources\AbstractResource;

class QuotationsResource extends AbstractResource
{
    public function create(Quotation $quotation): QuotationResponse
    {
        $response = $this->send('POST', 'quotations', $quotation);

        return new QuotationResponse($response);
    }

    public function get(string $quotationId): QuotationResponse
    {
        $response = $this->send('GET', "quotations/$quotationId");

        return new QuotationResponse($response);
    }
}