<?php

declare(strict_types=1);

namespace Lalamove\Responses\V2;

class QuotationResponse
{
    public ?string $totalFeeCurrency;

    public ?string $totalFee;

    public function __construct(object $response = null)
    {
        $this->totalFeeCurrency = $response ? $response->totalFeeCurrency : null;
        $this->totalFee = $response ? $response->totalFee : null;
    }
}