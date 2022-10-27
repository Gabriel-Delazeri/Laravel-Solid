<?php

namespace App\Patterns\Discounts;

use App\Models\Product;

class TwentyPercentDiscount implements Discountable
{
    public function apply($product)
    {
        $discount = 0.20 * $product->price;
        return number_format(($product->price - $discount),2);
    }
}
