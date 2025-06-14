<?php

namespace App\Domain\Places\Services;

use App\Domain\Places\Repositories\PlaceRepository;
use App\Domain\Shared\Services\AbstractService;

class PlaceService extends AbstractService
{
    protected $repository;

    public function __construct(PlaceRepository $repository)
    {
        $this->repository = $repository;
    }
}
