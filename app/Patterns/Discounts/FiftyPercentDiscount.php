<?php

namespace App\Patterns\Discounts;

class FiftyPercentDiscount implements Discountable
{
    public function apply($product)
    {
        $discount = 0.50 * $product->price;
        return number_format(($product->price - $discount),2);
    }
}
