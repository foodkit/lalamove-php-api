<?php

namespace Lalamove\Requests\V3;

class Item
{
    const CATEGORY_FOOD_DELIVERY = 'FOOD_DELIVERY';
    const CATEGORY_OFFICE_ITEM = 'OFFICE_ITEM';

    const HANDLING_INSTRUCTIONS_KEEP_UPRIGHT = 'KEEP_UPRIGHT';
    const HANDLING_INSTRUCTIONS_FRAGILE = 'FRAGILE';

    public $quantity;

    public $weight;

    public $categories;

    public $handlingInstructions;

    public function __construct($quantity, $weight, $categories, $handlingInstructions)
    {
        $this->quantity = $quantity;
        $this->weight = $weight;
        $this->categories = $categories;
        $this->handlingInstructions = $handlingInstructions;
    }
}
