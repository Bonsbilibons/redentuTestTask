<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository
{
    /**
     * @return Builder[]|Collection
     */
    public function getAll()
    {
        return Category::query()->get();
    }

    /**
     * @param array $rubrics
     * @return void
     */
    public function massCreate(array $rubrics): void
    {
        Category::query()->insert($rubrics);
    }
}
