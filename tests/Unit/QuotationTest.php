<?php

declare(strict_types=1);

namespace LalamoveTests\Unit;

use Lalamove\Requests\V2\Quotation;
use LalamoveTests\BaseTest;

class QuotationTest extends BaseTest
{
    public function test_it_instantiates()
    {
        $quotation = new Quotation();
        $this->assertNotEmpty($quotation);
    }

    public function test_it_can_be_cast_to_array()
    {
        $quotation = new Quotation();
        $arrQuotation = (array) $quotation;

        $this->assertArrayHasKey('scheduleAt', $arrQuotation);
    }

    public function test_special_request_can_be_added()
    {
        $quotation = new Quotation();
        $this->assertEmpty($quotation->specialRequests);
        $quotation->addSpecialRequest(Quotation::SPECIAL_REQUEST_BAG);
        $this->assertCount(1, $quotation->specialRequests);
        $this->assertEquals(Quotation::SPECIAL_REQUEST_BAG, $quotation->specialRequests[0]);
    }
}