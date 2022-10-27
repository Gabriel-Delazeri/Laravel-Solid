<?php

namespace App\Repositories;

use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;

class MysqlProductRepository implements ProductRepositoryInterface
{
    public function getById($product_id)
    {
        return DB::table('products')->find($product_id);
    }
}

