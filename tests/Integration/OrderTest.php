<?php

declare(strict_types=1);

namespace LalamoveTests\Integration;

use LalamoveTests\BaseTest;

class OrderTest extends BaseTest
{
    public function test_it_should_create_order()
    {
        $this->skipIfCredentialsMissing();
        
        $order = $this->prepareOrder();

        $response = $this->getClient()->orders()->create($order);

        $this->assertObjectHasAttribute('orderId', $response);
        $this->assertObjectHasAttribute('quotationId', $response);
        $this->assertObjectHasAttribute('priceBreakdown', $response);
        $this->assertObjectHasAttribute('driverId', $response);
        $this->assertObjectHasAttribute('shareLink', $response);
        $this->assertObjectHasAttribute('status', $response);
        $this->assertObjectHasAttribute('distance', $response);
        $this->assertObjectHasAttribute('stops', $response);
    }

    public function test_it_should_get_order_by_id()
    {
        $this->skipIfCredentialsMissing();
        
        $order = $this->prepareOrder();

        $response = $this->getClient()->orders()->create($order);

        $response = $this->getClient()->orders()->details($response->orderId);

        $this->assertObjectHasAttribute('orderId', $response);
        $this->assertObjectHasAttribute('quotationId', $response);
        $this->assertObjectHasAttribute('priceBreakdown', $response);
        $this->assertObjectHasAttribute('driverId', $response);
        $this->assertObjectHasAttribute('shareLink', $response);
        $this->assertObjectHasAttribute('status', $response);
        $this->assertObjectHasAttribute('distance', $response);
        $this->assertObjectHasAttribute('stops', $response);
    }

    public function test_it_should_cancel_order_by_id()
    {
        $this->skipIfCredentialsMissing();
        
        $order = $this->prepareOrder();

        $response = $this->getClient()->orders()->create($order);

        $response = $this->getClient()->orders()->cancel($response->orderId);

        $this->assertTrue($response);
    }
}