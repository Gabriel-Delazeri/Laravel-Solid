<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Contracts\RepositoryInterface;

class DatabaseRepository extends RepositoryAbstract
{
    public function all() : Collection
    {
        return Product::all();
    }
}
