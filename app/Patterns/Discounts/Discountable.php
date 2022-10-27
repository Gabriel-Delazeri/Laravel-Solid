<?php

namespace App\Patterns\Discounts;

use App\Models\Product;

interface Discountable
{
    public function apply($product);
}
