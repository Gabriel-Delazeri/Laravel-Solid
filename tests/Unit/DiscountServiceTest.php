<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
use App\Services\DiscountService;
use Illuminate\Foundation\Testing\WithFaker;
use App\Patterns\Discounts\FiftyPercentDiscount;
use App\Patterns\Discounts\TwentyPercentDiscount;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DiscountServiceTest extends TestCase
{
    public function test_it_applies_20_percent_discount_correctly(): void
    {
        $product = factory(Product::class)->make([
            'price' => 40
        ]);

        $discountService = new DiscountService(new TwentyPercentDiscount);
        $total = $discountService->with($product)->apply();

        $this->assertSame(32, intval($total));
    }

    public function test_it_applies_50_percent_discount_correctly(): void
    {
        $product = factory(Product::class)->make([
            'price' => 40
        ]);

        $total = DiscountService::make(new FiftyPercentDiscount)->with($product)->apply();

        $this->assertSame(20, intval($total));
    }
    public function test_it_applies_20_percent_discount_correctly_if_service_is_instantiated_through_make_method() : void
    {
        $product = factory(Product::class)->make([
            'price' => 40
        ]);

        $total = DiscountService::make(new TwentyPercentDiscount)->with($product)->apply();

        $this->assertSame(32, intval($total));
    }
}
