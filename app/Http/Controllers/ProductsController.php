<?php

namespace App\Http\Controllers;

use App\Repositories\ApiRepository;
use App\Repositories\DatabaseRepository;

class ProductsController extends Controller
{
    public function index(ApiRepository $repository)
    {
        $products = $repository->all();

        return view('welcome', compact('products'));
    }
}
