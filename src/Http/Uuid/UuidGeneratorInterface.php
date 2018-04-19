<?php

namespace Lalamove\Http\Uuid;

interface UuidGeneratorInterface
{
    /**
     * @return string
     */
    public function getUuid();
}