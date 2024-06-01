<?php

namespace App\Repositories;

use App\DTO\Goods\CreateGoodsDTO;
use App\Models\Goods;
use function PHPUnit\Framework\assertInstanceOf;

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

    public function create(CreateGoodsDTO $createGoodsDTO): Goods
    {
        $goods = Goods::firstOrCreate($createGoodsDTO->getDataAsArray());

        return $goods;
    }

    public function massCreateThroughDTOs(array $goodsDTOs): void
    {
        $chunkSize = 100;

        $chunks = array_chunk($goodsDTOs, $chunkSize);

        foreach ($chunks as $chunk) {
            $data = [];
            foreach ($chunk as $goodsDTO) {
                $data[] = $goodsDTO->getDataAsArray();
            }
            Goods::query()->insert($data);
        }
    }

    public function massCreate(array $data): void
    {
        $chunkSize = 100;

        $chunks = array_chunk($data, $chunkSize);

        foreach ($chunks as $chunk) {
            Goods::query()->insert($chunk);
        }
    }
}