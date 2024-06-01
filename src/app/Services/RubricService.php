<?php

namespace App\Services;

use App\DTO\Rubric\CreateRubricDTO;
use App\Models\Rubric;
use App\Repositories\RubricRepository;

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

    public function getAll()
    {
        return $this->rubricRepository->getAll();
    }

    /**
     * @param CreateRubricDTO $createRubricDTO
     * @return Rubric
     */
    public function create(CreateRubricDTO $createRubricDTO): Rubric
    {
        return $this->rubricRepository->create($createRubricDTO);
    }

    public function massCreate(array $rubrics): void
    {
        $this->rubricRepository->massCreate($rubrics);
    }
}
