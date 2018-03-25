<?php

namespace Lalamove;

class Quotation
{
    public $scheduleAt;
    public $serviceType = 'DELIVERY';
    public $specialRequests = [];
    public $requesterContact;
    public $stops = [];
    public $deliveries = [];
}
