<?php

namespace App\Repositories;

use App\DTO\Rubric\CreateRubricDTO;
use App\Models\Rubric;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Routing\Route;

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
     * @param CreateRubricDTO $rubricData
     * @return Rubric
     */
    public function create(CreateRubricDTO $rubricData)
    {
        $rubric = new Rubric();
        $rubric->fill($rubricData->getDataAsArray());
        $rubric->save();

        return $rubric;
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
