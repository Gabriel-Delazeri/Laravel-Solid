<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use App\Repositories\ApiRepository;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_browse_all_products(): void
    {
        // $products = factory(Product::class, 10)->create();
        $products = app(ApiRepository::class)->all();

        $response = $this->get('/')->assertOk();

        $data = $response->viewData('products');

        $this->assertSame($products->count(), $data->count());
        $this->assertInstanceOf(Product::class, $data->first());
    }
}
