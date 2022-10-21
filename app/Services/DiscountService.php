<?php

namespace App\Services;

class DiscountService
{
    public const DISCOUNT = 0.20;
    protected $product;

    public function with($product)
    {
        $this->product = $product;
        return $this;
    }

    public function applySpecialDiscount()
    {
        $discount = self::DISCOUNT * $this->product->price;
        return number_format(($this->product->price - $discount),2);
    }

}
