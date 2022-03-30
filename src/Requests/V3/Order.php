<?php

declare(strict_types=1);

namespace Lalamove\Requests\V3;

class Order
{
    public string $quotationId;

    public Contact $sender;

    /** @var Delivery[] */
    public array $recipients;

    public bool $isPODEnabled = true;

    public bool $isRecipientSMSEnabled = true;

    public string $partner; 

    public function __construct(string $quotationId, Contact $sender, array $recipients, $isPODEnabled = true, $isRecipientSMSEnabled = true, $partner = '')
    {
        $this->quotationId = $quotationId;
        $this->sender = $sender;
        $this->recipients = $recipients;
        $this->isPODEnabled = $isPODEnabled;
        $this->isRecipientSMSEnabled = $isRecipientSMSEnabled;

        if ($partner) {
            $this->partner = $partner;
        }
    }

    public function addRecipient(Delivery $recipient): void
    {
        $this->recipients = array_merge($this->recipients, $recipient);
    }

    public function disablePOD(): void
    {
        $this->isPODEnabled = false;
    }

    public function disableRecipient(): void
    {
        $this->isRecipientSMSEnabled = false;
    }

    public function setPartner(string $partner): void
    {
        $this->partner = $partner;
    }
}
