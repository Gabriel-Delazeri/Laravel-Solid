<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Stock;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderProcessTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_user_order_can_be_processed() : void
    {
        $product = factory(Product::class)->create();
        $stock = factory(Stock::class)->create([
            'product_id' => $product->id
        ]);

        $response = $this->post("/order/{$product->id}/process", [
            'payment_method' => 'stripe'
        ])->assertOk()->json();

        $this->assertArrayHasKey('payment_message', $response);
        $this->assertArrayHasKey('discounted_price', $response);
        $this->assertArrayHasKey('original_price', $response);
        $this->assertArrayHasKey('message', $response);

        $this->assertDatabaseHas('stocks', [
            'quantity' => $stock->quantity - 1
        ]);

    }
    /** @test */
    public function an_exception_is_thrown_when_product_is_out_of_stock(): void
    {
        $this->expectException(ValidationException::class);

        $product = factory(Product::class)->create();
        $stock = factory(Stock::class)->create([
            'quantity' => 0,
            'product_id' => $product->id
        ]);

        $this->withoutExceptionHandling()->post("/order/{$product->id}/process", [
            'payment_method' => 'stripe'
        ]);
    }
}
