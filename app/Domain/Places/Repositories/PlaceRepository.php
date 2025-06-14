<?php

namespace App\Domain\Places\Repositories;

use App\Domain\Shared\Repositories\AbstractRepository;
use App\Models\Place;

class PlaceRepository extends AbstractRepository
{
    public function __construct(Place $model)
    {
        $this->model = $model;
    }
}
