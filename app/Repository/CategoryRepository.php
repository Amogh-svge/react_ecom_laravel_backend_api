<?php

namespace App\Repository;

use App\Models\Category;
use App\Models\Subcategory;
use App\Repository\BaseRepository;

class CategoryRepository extends BaseRepository
{
    protected Subcategory $subCategoryModel;

    public function __construct(Category $model, Subcategory $subCategoryModel)
    {
        parent::__construct($model);
        $this->subCategoryModel = $subCategoryModel;
    }


    public function firstCategoryByName(string $category_name): object
    {
        return  $this->where('category_name', $category_name, true);
    }
}
