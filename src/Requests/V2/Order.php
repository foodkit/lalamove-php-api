<?php

namespace Lalamove\Requests\V2;

use Lalamove\Responses\V2\QuotationResponse;

class Order extends Quotation
{
    /** @var QuotedTotalFee */
    public $quotedTotalFee;
    /** @var string */
    public $callerSideCustomerOrderId;
    /** @var bool */
    public $sms = true;

    /**
     * @param Quotation $quotation
     * @param \Lalamove\Responses\V2\QuotationResponse $response
     * @param string $callerSideCustomerOrderId
     * @param bool $sms
     * @return static
     */
    public static function makeFromQuote(Quotation $quotation, QuotationResponse $response, $callerSideCustomerOrderId = '', $sms = true)
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
