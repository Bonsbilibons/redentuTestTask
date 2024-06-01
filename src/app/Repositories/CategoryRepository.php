<?php

namespace App\Repositories;

use App\DTO\Category\CreateCategoryDTO;
use App\Models\Category;

class CategoryRepository
{
    public function getAll()
    {
        return Category::query()->get();
    }

    public function create(CreateCategoryDTO $createCategoryDTO): Category
    {
        $category = new Category();
        $category->fill($createCategoryDTO->getDataAsArray());
        $category->save();

        return $category;
    }

    public function massCreate(array $rubrics): void
    {
        Category::query()->insert($rubrics);
    }
}
