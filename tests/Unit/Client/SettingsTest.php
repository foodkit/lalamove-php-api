<?php

namespace LalamoveTests\Unit\Client;

use Lalamove\Client\V2\Settings;
use Lalamove\Client\V3\Settings as V3Settings;
use LalamoveTests\BaseTest;

class SettingsTest extends BaseTest
{
    public $testHost = 'https://testhost.com';
    public $testCustomerId = 'wgmsqqh208fxic9vcqwruk2tciicielf';
    public $testPrivateKey = 'kGEX69NLd33+J/FQGdx8jOLAO1JZVPrHzQpuZDrWGxlftbu2tKFiVkptTSfPaj==';
    public $testCountry = 'JP';
    public $testVersion = 42;

    public $v3host = 'https://testhost.com';
    public $v3apiKey = 'wgmsqqh208fxic9vcqwruk2tciicielf';
    public $v3apiSecret = 'kGEX69NLd33+J/FQGdx8jOLAO1JZVPrHzQpuZDrWGxlftbu2tKFiVkptTSfPaj==';
    public $v3country = 'JP';
    public $v3version = 3;

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

    public function test_it_works_with_individual_parameters_v3()
    {
        $settings = new V3Settings(
            $this->v3host,
            $this->v3apiKey,
            $this->v3apiSecret,
            $this->v3country,
            $this->v3version
        );

        $this->assertSettingsMatchV3($settings);
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

    protected function assertSettingsMatchV3(\Lalamove\Client\V3\Settings $settings)
    {
        $this->assertEquals($this->v3host, $settings->host);
        $this->assertEquals($this->v3apiKey, $settings->apiKey);
        $this->assertEquals($this->v3apiSecret, $settings->apiSecret);
        $this->assertEquals($this->v3country, $settings->country);
        $this->assertEquals($this->v3version, $settings->version);
    }
}