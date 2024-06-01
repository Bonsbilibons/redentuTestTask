<?php

namespace App\Services;

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
     * @param array $data
     * @return void
     */
    public function massCreate(array $data): void
    {
        $this->goodsRepository->massCreate($data);
    }
}
