<?php

namespace App\Services;

use App\DTO\Category\CreateCategoryDTO;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * @param CategoryRepository$categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return Builder[]|Collection
     */
    public function getAll()
    {
        return $this->categoryRepository->getAll();
    }

    /**
     * @param CreateCategoryDTO $createCategoryDTO
     * @return Category
     */
    public function create(CreateCategoryDTO $createCategoryDTO): Category
    {
        return $this->categoryRepository->create($createCategoryDTO);
    }

    /**
     * @param array $rubrics
     * @return void
     */
    public function massCreate(array $rubrics): void
    {
        $this->categoryRepository->massCreate($rubrics);
    }
}
