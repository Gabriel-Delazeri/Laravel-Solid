<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('area', function(App\Patterns\AreaCalculator $areaCalculator) {

    $triangle = new \App\Patterns\Triangle(10, 10);
    $square = new \App\Patterns\Square(10, 10);

    return $areaCalculator->calculate($triangle);
});


