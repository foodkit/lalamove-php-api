<?php

declare(strict_types=1);

namespace Lalamove\Http\Uuid;

interface UuidGeneratorInterface
{
    public function getUuid(): string;
}