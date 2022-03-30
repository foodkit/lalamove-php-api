<?php

namespace LalamoveTests\Integration;

use Carbon\Carbon;
use Lalamove\Requests\V3\Contact;
use Lalamove\Requests\V3\Item;
use Lalamove\Requests\V3\Order;
use Lalamove\Requests\V3\Quotation;
use LalamoveTests\BaseTest;

class DriverTest extends BaseTest
{
    public function test_it_should_get_driver_by_order_id_and_driver_id()
    {
        $this->skipIfCredentialsMissing();
        
        // @todo Test driver
        $this->assertTrue(true);
    }
}