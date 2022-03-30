<?php

declare(strict_types=1);

namespace Lalamove\Requests\V2;

use Lalamove\Responses\V2\QuotationResponse;

class Order extends Quotation
{
    public QuotedTotalFee $quotedTotalFee;

    public string $callerSideCustomerOrderId;

    public bool $sms = true;

    public static function makeFromQuote(Quotation $quotation, QuotationResponse $response, $callerSideCustomerOrderId = '', $sms = true): self
    {
        $instance = new static;
        $instance->set(
            $quotation->scheduleAt,
            $quotation->requesterContact,
            $quotation->stops,
            $quotation->deliveries,
            $quotation->serviceType,
            $quotation->specialRequests,
            $quotation->fleetPriority,
            $quotation->promoCode
        );

        $instance->quotedTotalFee = new QuotedTotalFee($response->totalFee, $response->totalFeeCurrency);
        $instance->callerSideCustomerOrderId = $callerSideCustomerOrderId;
        $instance->sms = $sms;

        return $instance;
    }
}
