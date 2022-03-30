<?php

declare(strict_types=1);

namespace LalamoveTests\Integration;

use Lalamove\Client\V3\Client;
use Lalamove\Client\V3\Settings;

trait UsesLalamoveApi
{
    protected function skipIfCredentialsMissing(): void
    {
        if (! $this->hasCredentials()) {
            $this->markTestSkipped('Lalamove credentials are missing - skipping integration tests.');
        }
    }

    protected function hasCredentials(): bool
    {
        return $this->getCredentials() !== null;
    }

    /**
     * @return ?string[]
     */
    protected function getCredentials(): ?array
    {
        $key = getenv('LALAMOVE_API_KEY');
        $secret = getenv('LALAMOVE_API_SECRET');

        if (!$key || !$secret) {
            return null;
        }

        return ["{$key}", "{$secret}"];
    }

    protected function getSettings(): Settings
    {
        [$key, $secret] = $this->getCredentials();

        return new Settings(
            'https://rest.sandbox.lalamove.com', // Use sandbox host, not production
            "{$key}",
            "{$secret}",
            $country = Settings::COUNTRY_THAILAND
        );
    }

    protected function getClient(): Client
    {
        return new Client($this->getSettings());
    }
}