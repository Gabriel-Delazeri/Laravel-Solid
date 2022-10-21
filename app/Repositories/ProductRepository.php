<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class ProductRepository
{
    public function getById($product_id)
    {
        return DB::table('products')->find($product_id);
    }
}

