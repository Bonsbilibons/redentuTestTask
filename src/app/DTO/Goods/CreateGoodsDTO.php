<?php

namespace App\DTO\Goods;

class CreateGoodsDTO
{
    /**
     * @var string|null
     */
    protected $title;

    /**
     * @var string
     */
    protected $article;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var float
     */
    protected $cost;

    /**
     * @var string
     */
    protected $warranty;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var int
     * @description foreign key rubric_id on rubrics.id
     */
    protected $rubricId;

    /**
     * @var int
     * @description foreign key subrubric_id on subrubrics.id
     */
    protected $subrubricId;

    /**
     * @var int
     * @description foreign key category_id on categories.id
     */
    protected $categoryId;

    /**
     * @var int
     * @description foreign key manufacturer_id on manufacturers.id
     */
    protected $manufacturerId;

    /**
     * @param string|null $title
     * @param string $article
     * @param string $description
     * @param float $cost
     * @param string $warranty
     * @param string $status
     * @param int|null $rubricId
     * @param int|null $subrubricId
     * @param int|null $categoryId
     * @param int|null $manufacturerId
     */
    public function __construct(
        string|null $title,
        string $article,
        string $description,
        float $cost,
        string $warranty,
        string $status,
        int|null $rubricId,
        int|null $subrubricId,
        int|null $categoryId,
        int|null $manufacturerId)
    {
        $this->title = $title;
        $this->article = $article;
        $this->description = $description;
        $this->cost = $cost;
        $this->warranty = $warranty;
        $this->status = $status;
        $this->rubricId = $rubricId;
        $this->subrubricId = $subrubricId;
        $this->categoryId = $categoryId;
        $this->manufacturerId = $manufacturerId;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function getArticle(): string
    {
        return $this->article;
    }

    public function setArticle(string $article): void
    {
        $this->article = $article;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getCost(): float
    {
        return $this->cost;
    }

    public function setCost(float $cost): void
    {
        $this->cost = $cost;
    }

    public function getWarranty(): string
    {
        return $this->warranty;
    }

    public function setWarranty(string $warranty): void
    {
        $this->warranty = $warranty;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getRubricId(): ?int
    {
        return $this->rubricId;
    }

    public function setRubricId(?int $rubricId): void
    {
        $this->rubricId = $rubricId;
    }

    public function getSubrubricId(): ?int
    {
        return $this->subrubricId;
    }

    public function setSubrubricId(?int $subrubricId): void
    {
        $this->subrubricId = $subrubricId;
    }

    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    public function setCategoryId(?int $categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    public function getManufacturerId(): ?int
    {
        return $this->manufacturerId;
    }

    public function setManufacturerId(?int $manufacturerId): void
    {
        $this->manufacturerId = $manufacturerId;
    }

    /**
     * @return array[]
     */
    public function getDataAsArray(): array
    {
        return [
            'title'           => $this->title,
            'article'         => $this->article,
            'description'     => $this->description,
            'cost'            => $this->cost,
            'warranty'        => $this->warranty,
            'status'          => $this->status,
            'rubric_id'       => $this->rubricId,
            'subrubric_id'    => $this->subrubricId,
            'category_id'     => $this->categoryId,
            'manufacturer_id' => $this->manufacturerId
        ];
    }
}
