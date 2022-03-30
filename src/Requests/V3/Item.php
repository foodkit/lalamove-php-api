<?php

namespace Lalamove\Requests\V3;

class Item
{
    const CATEGORY_FOOD_DELIVERY = 'FOOD_DELIVERY';
    const CATEGORY_OFFICE_ITEM = 'OFFICE_ITEM';

    const HANDLING_INSTRUCTIONS_KEEP_UPRIGHT = 'KEEP_UPRIGHT';
    const HANDLING_INSTRUCTIONS_FRAGILE = 'FRAGILE';

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
