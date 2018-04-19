<?php

namespace Lalamove;

class QuotationResponse
{
    public $totalFeeCurrency;
    public $totalFee;

    /**
     * QuotationResponse constructor.
     * @param $response
     */
    public function __construct($response)
    {
        $this->totalFeeCurrency = $response->totalFeeCurrency;
        $this->totalFee = $response->totalFee;
    }
}