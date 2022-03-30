<?php

namespace Lalamove\Requests\V2;

class QuotedTotalFee
{
    /** @var string */
    public $amount;
    /** @var string */
    public $currency;

    public function __construct($amount, $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }
}