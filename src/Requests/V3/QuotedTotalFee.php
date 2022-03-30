<?php

namespace Lalamove\Requests\V3;

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