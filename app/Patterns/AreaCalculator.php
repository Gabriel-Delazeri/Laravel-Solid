<?php

namespace App\Patterns;

interface Shapable
{
    public function area();
}

class Square implements Shapable
{
    public $width;
    public $height;

    public function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    public function area()
    {
        return $this->width * $this->height;
    }
}

class Triangle implements Shapable
{
    public $width;
    public $height;

    public function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    public function area()
    {
        return $this->width * $this->height / 2;
    }
}

class AreaCalculator
{
    public function calculate(Shapable $shapable)
    {
        return $shapable->area();
    }

}
