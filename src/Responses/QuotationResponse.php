<?php

namespace Lalamove\Responses;

class QuotationResponse
{
    public $totalFeeCurrency;
    public $totalFee;

    /**
     * Pass in the deserialized JSON response to populate all relevant fields.
     * @param object $response
     */
    public function __construct($response = null)
    {
        $this->totalFeeCurrency = $response ? $response->totalFeeCurrency : null;
        $this->totalFee = $response ? $response->totalFee : null;
    }
}