<?php

namespace App\Repositories;

use App\DTO\Manufacturer\CreateManufacturerDTO;
use App\Models\Manufacturer;

class ManufacturerRepository
{
    public function getAll()
    {
        return Manufacturer::query()->get();
    }

    public function create(CreateManufacturerDTO $createManufacturerDTO): Manufacturer
    {
        $manufacturer = new Manufacturer();
        $manufacturer->fill($createManufacturerDTO->getDataAsArray());
        $manufacturer->save();

        return $manufacturer;
    }

    public function massCreate(array $rubrics): void
    {
        Manufacturer::query()->insert($rubrics);
    }
}
