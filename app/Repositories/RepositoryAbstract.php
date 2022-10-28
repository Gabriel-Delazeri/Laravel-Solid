<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

abstract class RepositoryAbstract
{
    /**
     * @return Collection;
     */
    abstract public function all() : Collection;
}
