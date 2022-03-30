<?php

namespace Lalamove\Requests\V3;

class Order
{
    /** @var int */
    public $quotationId;

    /** @var Contact */
    public $sender;

    /** @var Delivery[] */
    public $recipients;

    /** @var boolean */
    public $isPODEnabled = true;

    /** @var boolean */
    public $isRecipientSMSEnabled = true;

    /** @var string */
    // public $partner = '';

    public function __construct($quotationId, $sender, $recipients, $isPODEnabled = true, $isRecipientSMSEnabled = true, $partner = '')
    {
        $this->quotationId = $quotationId;
        $this->sender = $sender;
        $this->recipients = $recipients;
        $this->isPODEnabled = $isPODEnabled;
        $this->isRecipientSMSEnabled = $isRecipientSMSEnabled;
        // $this->partner = $partner;
    }

    /**
     * Add order recipients
     * 
     * @param Delivery $recipient
     */
    public function addRecipient($recipient)
    {
        $this->recipients = array_merge($this->recipients, $recipient);
    }

    public function disablePOD()
    {
        $this->isPODEnabled = false;
    }

    public function disableRecipient()
    {
        $this->isRecipientSMSEnabled = false;
    }

    /**
     * Manually set partner
     * 
     * @param string $partner
     */
    public function setPartner($partner)
    {
        $this->partner = $partner;
    }
}
