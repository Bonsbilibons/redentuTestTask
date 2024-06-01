<?php

namespace App\Services;

use App\DTO\SubRubric\CreateSubrubricDTO;
use App\Models\Subrubric;
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
     * @return Builder[]|Collection
     */
    public function getAll()
    {
        return $this->subrubricRepository->getAll();
    }

    /**
     * @param CreateSubrubricDTO $createSubrubricDTO
     * @return Subrubric
     */
    public function create(CreateSubrubricDTO $createSubrubricDTO): Subrubric
    {
        return $this->subrubricRepository->create($createSubrubricDTO);
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
