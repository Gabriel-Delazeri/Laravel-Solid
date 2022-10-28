<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Facades\File;
use App\Repositories\RepositoryAbstract;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Contracts\RepositoryInterface;

class ApiRepository extends RepositoryAbstract
{
    public function all() : Collection
    {
        $products = File::get(storage_path('products.json'));

        $products = json_decode($products, true);
        $products = Product::hydrate($products);

        return $products;
    }
}
