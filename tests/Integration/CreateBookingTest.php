<?php

declare(strict_types=1);

namespace LalamoveTests\Integration;

use LalamoveTests\BaseTest;

class CreateBookingTest extends BaseTest
{
    public function test_it_creates_a_booking()
    {
        $this->skipIfCredentialsMissing();

        $client = $this->getClient();

        $quotation = $this->prepareQuotation();

        $response = $client->quotations()->create($quotation);

        $this->assertObjectHasAttribute('quotationId', $response);
        $this->assertObjectHasAttribute('scheduleAt', $response);
        $this->assertObjectHasAttribute('expiresAt', $response);
        $this->assertObjectHasAttribute('serviceType', $response);
        $this->assertObjectHasAttribute('language', $response);
        $this->assertObjectHasAttribute('specialRequests', $response);
        $this->assertObjectHasAttribute('stops', $response);
        $this->assertObjectHasAttribute('isRouteOptimized', $response);
        $this->assertObjectHasAttribute('priceBreakdown', $response);
        $this->assertObjectHasAttribute('item', $response);
    }

    public function test_it_should_get_booking_by_quotation_id()
    {
        $this->skipIfCredentialsMissing();

        $client = $this->getClient();

        $quotation = $this->prepareQuotation();

        $response = $client->quotations()->create($quotation);

        $response = $client->quotations()->get($response->quotationId);

        $this->assertObjectHasAttribute('quotationId', $response);
        $this->assertObjectHasAttribute('scheduleAt', $response);
        $this->assertObjectHasAttribute('expiresAt', $response);
        $this->assertObjectHasAttribute('serviceType', $response);
        $this->assertObjectHasAttribute('language', $response);
        $this->assertObjectHasAttribute('specialRequests', $response);
        $this->assertObjectHasAttribute('stops', $response);
        $this->assertObjectHasAttribute('isRouteOptimized', $response);
        $this->assertObjectHasAttribute('priceBreakdown', $response);
        $this->assertObjectHasAttribute('item', $response);
    }
}