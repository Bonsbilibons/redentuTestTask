<?php

namespace App\Services;

use App\DTO\Category\CreateCategoryDTO;
use App\DTO\Goods\CreateGoodsDTO;
use App\DTO\Manufacturer\CreateManufacturerDTO;
use App\DTO\Rubric\CreateRubricDTO;
use App\DTO\SubRubric\CreateSubrubricDTO;

class UploaderService
{
    /**
     * @var CategoryService
     */
    protected $categoryService;

    /**
     * @var GoodsService
     */
    protected $goodsService;

    /**
     * @var ManufacturerService
     */
    protected $manufacturerService;

    /**
     * @var RubricService
     */
    protected $rubricService;

    /**
     * @var SubrubricService
     */
    protected $subrubricService;

    /**
     * @param CategoryService $categoryService
     * @param GoodsService $goodsService
     * @param ManufacturerService $manufacturerService
     * @param RubricService $rubricService
     * @param SubrubricService $subrubricService
     */
    public function __construct(
        CategoryService     $categoryService,
        GoodsService        $goodsService,
        ManufacturerService $manufacturerService,
        RubricService       $rubricService,
        SubrubricService    $subrubricService)
    {
        $this->categoryService = $categoryService;
        $this->goodsService = $goodsService;
        $this->manufacturerService = $manufacturerService;
        $this->rubricService = $rubricService;
        $this->subrubricService = $subrubricService;
    }

    /**
     * @param array $tableData
     * @return array
     */
    public function processXLSXArray(array $tableData): array
    {
        array_shift($tableData);

        $rubrics = $this->rubricService->getAll()->keyBy('ident');
        $subrubrics = $this->subrubricService->getAll()->keyBy('ident');
        $categories = $this->categoryService->getAll()->keyBy('ident');
        $manufacturers = $this->manufacturerService->getAll()->keyBy('ident');
        $goodsArticles = $this->goodsService->getAllArticles();

        $recordsWithInvalidStructure = 0;
        $newGoodsDTOs = [];
        foreach ($tableData as $rowData) {
            if (!$this->__isUploadedXLSXRowValid($rowData)) {
                $recordsWithInvalidStructure++;
                continue;
            }

            $rowRubricIdent = $rowData[0];
            $rowSubrubricIdent = $rowData[1];
            $rowCategoryIdent = $rowData[2];
            $rowManufacturersIdent = $rowData[3];

            $rowRubricID = null;
            $rowSubrubricID = null;
            $rowCategoryID = null;
            $rowManufacturersID = null;
            $rowGoodsTitle = $rowData[4];
            $rowGoodsArticle = $rowData[5];
            $rowGoodsDescription = $rowData[6];
            $rowGoodsCost = $rowData[7];
            $rowGoodsWarranty = $rowData[8];
            $rowGoodsStatus = $rowData[9];

            if ((is_null($rowData[0]))) {
                $rowSubrubricIdent = null;
                $rowRubricIdent = $rowData[1];
            }
            if (is_null($rowData[0]) && !is_null($rowData[10])) {
                $rowManufacturersIdent = $rowData[4];
                $rowGoodsTitle = $rowData[5];
                $rowGoodsArticle = $rowData[6];
                $rowGoodsDescription = $rowData[7];
                $rowGoodsCost = $rowData[8];
                $rowGoodsWarranty = $rowData[9];
                $rowGoodsStatus = $rowData[10];
            }
            if (is_null($rowData[0]) && is_null($rowData[1])) {
                $rowRubricIdent = $rowData[2];
                $rowCategoryIdent = $rowData[3];
            }

            if (in_array($rowGoodsArticle, $goodsArticles)) {
                continue;
            }

            if (!is_null($rowRubricIdent) && !$rubrics->has($rowRubricIdent)) {
                $createRubricDTO = new CreateRubricDTO($rowRubricIdent);
                $rubric = $this->rubricService->create($createRubricDTO);

                $rowRubricID = $rubric->getAttribute('id');

                $rubrics[$rowRubricIdent] = $rubric;
            } else {
                $rowRubricID = $rubrics[$rowRubricIdent]->getAttribute('id');
            }

            if (!is_null($rowSubrubricIdent) && !$subrubrics->has($rowSubrubricIdent)) {
                $createSubrubricDTO = new CreateSubrubricDTO($rowSubrubricIdent);
                $subrubric = $this->subrubricService->create($createSubrubricDTO);

                $rowSubrubricID = $subrubric->getAttribute('id');

                $subrubrics[$rowSubrubricIdent] = $subrubric;
            } else if (!is_null($rowSubrubricIdent)) {
                $rowSubrubricID = $subrubrics[$rowSubrubricIdent]->getAttribute('id');
            }

            if (!$categories->has($rowCategoryIdent)) {
                $createCategoryDTO = new CreateCategoryDTO($rowCategoryIdent);
                $category = $this->categoryService->create($createCategoryDTO);

                $rowCategoryID = $category->getAttribute('id');

                $categories[$rowCategoryIdent] = $category;
            } else {
                $rowCategoryID = $categories[$rowCategoryIdent]->getAttribute('id');
            }

            if (!$manufacturers->has($rowManufacturersIdent)) {
                $createManufacturerDTO = new CreateManufacturerDTO($rowManufacturersIdent);
                $manufacturer = $this->manufacturerService->create($createManufacturerDTO);

                $rowManufacturersID = $manufacturer->getAttribute('id');

                $manufacturers[$rowManufacturersIdent] = $manufacturer;
            } else {
                $rowManufacturersID = $manufacturers[$rowManufacturersIdent]->getAttribute('id');
            }

            $createGoodsDTO = new CreateGoodsDTO(
                $rowGoodsTitle,
                $rowGoodsArticle,
                $rowGoodsDescription,
                $rowGoodsCost,
                $rowGoodsWarranty,
                $rowGoodsStatus,
                $rowRubricID,
                $rowSubrubricID,
                $rowCategoryID,
                $rowManufacturersID
            );
            $newGoodsDTOs[] = $createGoodsDTO;

            array_push($goodsArticles, $rowGoodsArticle);
        }
        $this->goodsService->massCreateThroughDTOs($newGoodsDTOs);

        $duplicatesCount = (count($tableData) - $recordsWithInvalidStructure - count($newGoodsDTOs));
        return [
            'records_with_invalid_structure' => $recordsWithInvalidStructure,
            'new_records_count'              => count($newGoodsDTOs),
            'duplicates_count'               => $duplicatesCount
        ];
    }

    /**
     * @param array $tableData
     * @return array
     */
    public function processXLSXArrayV2(array $tableData): array
    {
        array_shift($tableData);

        $rubricsExisted = $this->rubricService->getAll()->pluck('ident')->toArray();
        $subrubricsExisted = $this->subrubricService->getAll()->pluck('ident')->toArray();
        $categoriesExisted = $this->categoryService->getAll()->pluck('ident')->toArray();
        $manufacturersExisted = $this->manufacturerService->getAll()->pluck('ident')->toArray();
        $goodsArticles = $this->goodsService->getAllArticles();

        $rubrics = [];
        $categories = [];
        $subrubrics = [];
        $manufacturers = [];

        $recordsWithInvalidStructure = 0;
        $newGoods = [];
        foreach ($tableData as $rowData) {
            if (!$this->__isUploadedXLSXRowValid($rowData)) {
                $recordsWithInvalidStructure++;
                continue;
            }

            $rowRubricIdent = $rowData[0];
            $rowSubrubricIdent = $rowData[1];
            $rowCategoryIdent = $rowData[2];
            $rowManufacturersIdent = $rowData[3];

            $rowGoodsTitle = $rowData[4];
            $rowGoodsArticle = $rowData[5];
            $rowGoodsDescription = $rowData[6];
            $rowGoodsCost = $rowData[7];
            $rowGoodsWarranty = $rowData[8];
            $rowGoodsStatus = $rowData[9];

            if ((is_null($rowData[0]))) {
                $rowSubrubricIdent = null;
                $rowRubricIdent = $rowData[1];
            }
            if (is_null($rowData[0]) && !is_null($rowData[10])) {
                $rowManufacturersIdent = $rowData[4];
                $rowGoodsTitle = $rowData[5];
                $rowGoodsArticle = $rowData[6];
                $rowGoodsDescription = $rowData[7];
                $rowGoodsCost = $rowData[8];
                $rowGoodsWarranty = $rowData[9];
                $rowGoodsStatus = $rowData[10];
            }
            if (is_null($rowData[0]) && is_null($rowData[1])) {
                $rowRubricIdent = $rowData[2];
                $rowCategoryIdent = $rowData[3];
            }

            if (in_array($rowGoodsArticle, $goodsArticles)) {
                continue;
            }

            if (!is_null($rowRubricIdent) && !in_array($rowRubricIdent, $rubricsExisted)) {
                $rubrics[$rowRubricIdent] = [
                    'ident' => $rowRubricIdent
                ];
            }

            if (!is_null($rowSubrubricIdent) && !in_array($rowSubrubricIdent, $subrubricsExisted)) {
                $subrubrics[$rowSubrubricIdent] = [
                    'ident' => $rowSubrubricIdent
                ];
            }

            if (!in_array($rowCategoryIdent, $categoriesExisted)) {
                $categories[$rowCategoryIdent] = [
                    'ident' => $rowCategoryIdent
                ];
            }

            if (!in_array($rowManufacturersIdent, $manufacturersExisted)) {
                $manufacturers[$rowManufacturersIdent] = [
                    'ident' => $rowManufacturersIdent
                ];
            }

            if (in_array($rowGoodsArticle, $goodsArticles)) {
                continue;
            }

            $newGoods[$rowGoodsArticle] = [
                'title'           => $rowGoodsTitle,
                'article'         => $rowGoodsArticle,
                'description'     => $rowGoodsDescription,
                'cost'            => $rowGoodsCost,
                'warranty'        => $rowGoodsWarranty,
                'status'          => $rowGoodsStatus,
                'rubric_id'       => $rowRubricIdent,
                'subrubric_id'    => $rowSubrubricIdent,
                'category_id'     => $rowCategoryIdent,
                'manufacturer_id' => $rowManufacturersIdent
            ];
        }
        $originalTableRowsCount = count($tableData);
        unset($tableData);

        $this->rubricService->massCreate(array_values($rubrics));
        $this->subrubricService->massCreate(array_values($subrubrics));
        $this->categoryService->massCreate(array_values($categories));
        $this->manufacturerService->massCreate(array_values($manufacturers));

        $rubricsAll = $this->rubricService->getAll()->pluck('id', 'ident')->toArray();
        $subrubricsAll = $this->subrubricService->getAll()->pluck('id', 'ident')->toArray();
        $categoriesAll = $this->categoryService->getAll()->pluck('id', 'ident')->toArray();
        $manufacturersAll = $this->manufacturerService->getAll()->pluck('id', 'ident')->toArray();

        foreach ($newGoods as $id => $goods) {
            $newGoods[$id]['rubric_id']       = $rubricsAll[$goods['rubric_id']] ?? null;
            $newGoods[$id]['subrubric_id']    = $subrubricsAll[$goods['subrubric_id']] ?? null ;
            $newGoods[$id]['category_id']     = $categoriesAll[$goods['category_id']] ?? null ;
            $newGoods[$id]['manufacturer_id'] = $manufacturersAll[$goods['manufacturer_id']] ?? null ;
        }

        unset($rubricsAll);
        unset($subrubricsAll);
        unset($categoriesAll);
        unset($manufacturersAll);
        unset($rubricsExisted);
        unset($subrubricsExisted);
        unset($categoriesExisted);
        unset($manufacturersExisted);

        $this->goodsService->massCreate(array_values($newGoods));

        $duplicatesCount = ($originalTableRowsCount - $recordsWithInvalidStructure - count($newGoods));
        return [
            'records_with_invalid_structure' => $recordsWithInvalidStructure,
            'new_records_count'              => count($newGoods),
            'duplicates_count'               => $duplicatesCount
        ];
    }

    /**
     * @param array $row
     * @return bool
     */
    protected function __isUploadedXLSXRowValid(array $row): bool
    {
        return count($row) === 11 && (range(0, 10) === array_keys($row));
    }
}
