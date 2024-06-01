<?php

namespace App\Repositories;

use App\Models\Goods;

class GoodsRepository
{
    public function getAll()
    {
        return Goods::query()->get();
    }

    /**
     * @return array
     */
    public function getAllArticles(): array
    {
        return Goods::query()->pluck('article')->toArray();
    }

    /**
     * @param array $data
     * @return void
     */
    public function massCreate(array $data): void
    {
        $chunkSize = 1000;

        $chunks = array_chunk($data, $chunkSize);

        foreach ($chunks as $chunk) {
            Goods::query()->insert($chunk);
        }
    }
}
