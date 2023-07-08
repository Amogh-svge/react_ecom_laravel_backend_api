<?php

namespace App\Repository;

use App\Models\Category;
use App\Models\Subcategory;
use App\Repository\BaseRepository;

class CategoryRepository extends BaseRepository
{
    protected Subcategory $subCategoryModel;

    public function __construct(Category $categoryModel, Subcategory $subCategoryModel)
    {
        parent::__construct($categoryModel);
        $this->subCategoryModel = $subCategoryModel;
    }


    public function getByName(string $category_name, bool $first = false): object
    {
        $query = $this->where('category_name', $category_name);
        return ($first) ? $query->firstOrFail() : $query->get();
    }


    public function getSubCategoryByName(string $subcategory_name, bool $first = false): object
    {
        parent::__construct($this->subCategoryModel);
        $query = $this->where('subcategory_name', $subcategory_name);
        return ($first) ? $query->firstOrFail() : $query->get();
    }
}
