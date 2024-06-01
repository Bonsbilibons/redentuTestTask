<?php

namespace App\Repositories;

use App\DTO\SubRubric\CreateSubrubricDTO;
use App\Models\Subrubric;

class SubrubricRepository
{
    public function getAll()
    {
        return Subrubric::query()->get();
    }

    public function create(CreateSubrubricDTO $createSubrubricDTO): Subrubric
    {
        $subrubric = new Subrubric();
        $subrubric->fill($createSubrubricDTO->getDataAsArray());
        $subrubric->save();

        return $subrubric;
    }

    public function massCreate(array $rubrics): void
    {
        Subrubric::query()->insert($rubrics);
    }
}
