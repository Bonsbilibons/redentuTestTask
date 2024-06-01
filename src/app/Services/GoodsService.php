<?php

namespace App\Services;

use App\DTO\Goods\CreateGoodsDTO;
use App\Models\Goods;
use App\Repositories\GoodsRepository;

class GoodsService
{
    /**
     * @var GoodsRepository
     */
    protected $goodsRepository;

    /**
     * @param GoodsRepository $goodsRepository
     */
    public function __construct(GoodsRepository $goodsRepository)
    {
        $this->goodsRepository = $goodsRepository;
    }

    /**
     * @return array
     */
    public function getAllArticles(): array
    {
        return $this->goodsRepository->getAllArticles();
    }

    /**
     * @param CreateGoodsDTO $createGoodsDTO
     * @return Goods
     */
    public function create(CreateGoodsDTO $createGoodsDTO): Goods
    {
        return $this->goodsRepository->create($createGoodsDTO);
    }

    /**
     * @param CreateGoodsDTO[]|array $goodsDTOs
     * @return void
     */
    public function massCreate(array $goodsDTOs): void
    {
        $this->goodsRepository->massCreate($goodsDTOs);
    }

    /**
     * @param CreateGoodsDTO[]|array $goodsDTOs
     * @return void
     */
    public function massCreateThroughDTOs(array $goodsDTOs): void
    {
        $data = [];
        foreach ($goodsDTOs as $goodsDTO) {
            $data[] = $goodsDTO->getDataAsArray();
        }
        $this->goodsRepository->massCreate($data);
    }
}
