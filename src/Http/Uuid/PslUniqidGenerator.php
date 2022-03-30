<?php

declare(strict_types=1);

namespace Lalamove\Http\Uuid;

/**
 * Class PslUniqidGenerator
 * Generates a universally unique identifier using the PHP standard library uniqid() function.
 * @package Lalamove\Http
 */
class PslUniqidGenerator implements UuidGeneratorInterface
{
    public function getUuid(): string
    {
        return uniqid();
    }
}