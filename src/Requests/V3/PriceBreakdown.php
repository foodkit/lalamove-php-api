<?php

declare(strict_types=1);

namespace Lalamove\Requests\V3;

class PriceBreakdown
{
    public string $base;

    public string $extraMileage;

    public string $surcharge;

    public string $totalExcludePriorityFee;

    public string $total;

    public string $currency;

    public string $priorityFee;

    public function __construct(
        string $base,
        string $extraMileage,
        string $surcharge,
        string $totalExcludePriorityFee,
        string $total,
        string $currency,
        string $priorityFee
    )
    {
        $this->base = $base ?? null;
        $this->extraMileage = $extraMileage ?? null;
        $this->surcharge = $surcharge ?? null;
        $this->totalExcludePriorityFee = $totalExcludePriorityFee ?? null;
        $this->total = $total ?? null;
        $this->currency = $currency ?? null;
        $this->priorityFee = $priorityFee ?? null;
    }

    public static function make(
        string $base,
        string $extraMileage,
        string $surcharge,
        string $totalExcludePriorityFee,
        string $total,
        string $currency,
        string $priorityFee
    ): self
    {
        return new static(
            $base,
            $extraMileage,
            $surcharge,
            $totalExcludePriorityFee,
            $total,
            $currency,
            $priorityFee
        );
    }
}