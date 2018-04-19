<?php

namespace Lalamove\Responses;

class QuotationResponse
{
    public $totalFeeCurrency;
    public $totalFee;

    /**
     * QuotationResponse constructor.
     * @param object $response
     */
    public function __construct($response)
    {
        $this->totalFeeCurrency = $response->totalFeeCurrency;
        $this->totalFee = $response->totalFee;
    }
}