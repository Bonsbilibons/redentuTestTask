<?php

namespace App\Services;

use App\Repositories\ManufacturerRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ManufacturerService
{
    /**
     * @var ManufacturerRepository
     */
    protected $manufacturerRepository;

    /**
     * @param ManufacturerRepository $manufacturerRepository
     */
    public function __construct(ManufacturerRepository $manufacturerRepository)
    {
        $this->manufacturerRepository = $manufacturerRepository;
    }

    /**
     * @return Builder[]|Collection
     */
    public function getAll()
    {
        return $this->manufacturerRepository->getAll();
    }

    /**
     * @param array $rubrics
     * @return void
     */
    public function massCreate(array $rubrics): void
    {
        $this->manufacturerRepository->massCreate($rubrics);
    }
}
