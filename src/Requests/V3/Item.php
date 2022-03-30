<?php

declare(strict_types=1);

namespace Lalamove\Requests\V3;

class Item
{
    public const CATEGORY_FOOD_DELIVERY = 'FOOD_DELIVERY';
    public const CATEGORY_OFFICE_ITEM = 'OFFICE_ITEM';

    public const HANDLING_INSTRUCTIONS_KEEP_UPRIGHT = 'KEEP_UPRIGHT';
    public const HANDLING_INSTRUCTIONS_FRAGILE = 'FRAGILE';

    public string $quantity;

    public string $weight;

    /** @var string[] */
    public array $categories = [];

    /** @var string[] */
    public array $handlingInstructions = [];

    public function __construct(string $quantity, string $weight, array $categories = [], array $handlingInstructions = [])
    {
        $this->quantity = $quantity;
        $this->weight = $weight;
        $this->categories = $categories;
        $this->handlingInstructions = $handlingInstructions;
    }
}
