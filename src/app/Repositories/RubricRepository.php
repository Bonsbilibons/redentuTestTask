<?php

namespace App\Repositories;

use App\Models\Rubric;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class RubricRepository
{
    /**
     * @return Builder[]|Collection|Rubric[]
     */
    public function getAll()
    {
        return Rubric::query()->get();
    }

    /**
     * @param array $rubrics
     * @return void
     */
    public function massCreate(array $rubrics): void
    {
        Rubric::query()->insert($rubrics);
    }
}
