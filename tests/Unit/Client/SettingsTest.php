<?php

namespace LalamoveTests\Unit\Client;

use Lalamove\Client\V2\Settings;
use LalamoveTests\BaseTest;

class SettingsTest extends BaseTest
{
    public $testHost = 'https://testhost.com';
    public $testCustomerId = 'wgmsqqh208fxic9vcqwruk2tciicielf';
    public $testPrivateKey = 'kGEX69NLd33+J/FQGdx8jOLAO1JZVPrHzQpuZDrWGxlftbu2tKFiVkptTSfPaj==';
    public $testCountry = 'JP';
    public $testVersion = 42;

    public function test_it_works_with_individual_parameters()
    {
        $settings = new Settings(
            $this->testHost,
            $this->testCustomerId,
            $this->testPrivateKey,
            $this->testCountry,
            $this->testVersion
        );

        $this->assertSettingsMatch($settings);
    }

    public function test_it_works_with_an_array()
    {
        $settings = new \Lalamove\Client\V2\Settings([
            'host' => $this->testHost,
            'customerId' => $this->testCustomerId,
            'privateKey' => $this->testPrivateKey,
            'country' => $this->testCountry,
            'version' => $this->testVersion
        ]);

        $this->assertSettingsMatch($settings);
    }

    protected function assertSettingsMatch(\Lalamove\Client\V2\Settings $settings)
    {
        $this->assertEquals($this->testHost, $settings->host);
        $this->assertEquals($this->testCustomerId, $settings->customerId);
        $this->assertEquals($this->testPrivateKey, $settings->privateKey);
        $this->assertEquals($this->testCountry, $settings->country);
        $this->assertEquals($this->testVersion, $settings->version);
    }
}