<?php

namespace App\Services;

use App\DTO\Manufacturer\CreateManufacturerDTO;
use App\Models\Manufacturer;
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
     * @param CreateManufacturerDTO $createManufacturerDTO
     * @return Manufacturer
     */
    public function create(CreateManufacturerDTO $createManufacturerDTO): Manufacturer
    {
        return $this->manufacturerRepository->create($createManufacturerDTO);
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
