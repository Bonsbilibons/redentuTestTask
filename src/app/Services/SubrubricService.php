<?php

namespace App\Services;

use App\Models\Rubric;
use App\Repositories\SubrubricRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class SubrubricService
{
    /**
     * @var SubrubricRepository
     */
    protected $subrubricRepository;

    /**
     * @param SubrubricRepository $subrubricRepository
     */
    public function __construct(SubrubricRepository $subrubricRepository)
    {
        $this->subrubricRepository = $subrubricRepository;
    }

    /**
     * @return Builder[]|Collection|Rubric[]
     */
    public function getAll()
    {
        return $this->subrubricRepository->getAll();
    }

    /**
     * @param array $rubrics
     * @return void
     */
    public function massCreate(array $rubrics): void
    {
        $this->subrubricRepository->massCreate($rubrics);
    }
}
