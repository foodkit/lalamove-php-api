<?php

namespace Lalamove\Requests\V2;

class QuotedTotalFee
{
    public string $amount;

    public string $currency;

    public function __construct(string $amount, string $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }
}