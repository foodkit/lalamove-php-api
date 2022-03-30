<?php

namespace Lalamove\Http\Uuid;

interface UuidGeneratorInterface
{
    public function getUuid(): string;
}