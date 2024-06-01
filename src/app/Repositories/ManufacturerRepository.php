<?php

namespace App\Repositories;

use App\Models\Manufacturer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ManufacturerRepository
{
    /**
     * @return Builder[]|Collection
     */
    public function getAll()
    {
        return Manufacturer::query()->get();
    }

    /**
     * @param array $rubrics
     * @return void
     */
    public function massCreate(array $rubrics): void
    {
        Manufacturer::query()->insert($rubrics);
    }
}
