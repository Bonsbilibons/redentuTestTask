<?php

namespace App\Repositories;

use App\Models\Subrubric;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class SubrubricRepository
{
    /**
     * @return Builder[]|Collection|Subrubric[]
     */
    public function getAll()
    {
        return Subrubric::query()->get();
    }

    /**
     * @param array $rubrics
     * @return void
     */
    public function massCreate(array $rubrics): void
    {
        Subrubric::query()->insert($rubrics);
    }
}
