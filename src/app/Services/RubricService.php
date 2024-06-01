<?php

namespace App\Services;

use App\Models\Rubric;
use App\Repositories\RubricRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class RubricService
{
    /**
     * @var RubricRepository
     */
    protected $rubricRepository;

    /**
     * @param RubricRepository $rubricRepository
     */
    public function __construct(RubricRepository $rubricRepository)
    {
        $this->rubricRepository = $rubricRepository;
    }

    /**
     * @return Rubric[]|Builder[]|Collection
     */
    public function getAll()
    {
        return $this->rubricRepository->getAll();
    }

    /**
     * @param array $rubrics
     * @return void
     */
    public function massCreate(array $rubrics): void
    {
        $this->rubricRepository->massCreate($rubrics);
    }
}
