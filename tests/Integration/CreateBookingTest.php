<?php

namespace LalamoveTests\Integration;

use LalamoveTests\BaseTest;

class CreateBookingTest extends BaseTest
{
    use UsesLalamoveApi;

    public function test_it_creates_a_booking()
    {
        $this->skipIfCredentialsMissing();

        $client = $this->getClient();

        // @todo: fix assertions below, just to see if it works:
        print_r($client->quotations()->create());
    }

}