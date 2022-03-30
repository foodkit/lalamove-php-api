<?php

namespace Lalamove\Responses\V2;

class QuotationResponse
{
    public string $totalFeeCurrency;

    public string $totalFee;

    /**
     * Pass in the deserialized JSON response to populate all relevant fields.
     */
    public function __construct(object $response = null)
    {
        $this->totalFeeCurrency = $response ? $response->totalFeeCurrency : null;
        $this->totalFee = $response ? $response->totalFee : null;
    }
}