<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Category, Subcategory};
use App\Services\CategoryService;
use Illuminate\Http\{JsonResponse};

class CategoryController extends Controller
{
    protected Category $categoryModel;
    protected Subcategory $subcategoryModel;
    protected CategoryService $categoryService;

    public function __construct(Category $categoryModel, Subcategory $subcategoryModel, CategoryService $categoryService)
    {
        $this->categoryModel = $categoryModel;
        $this->subcategoryModel = $subcategoryModel;
        $this->categoryService = $categoryService;
    }


    public function allCategory(): JsonResponse
    {
        $categories = $this->categoryModel->select(['category_name', 'category_image'])->get();
        $category = $this->categoryService->allCategory($categories);
        return $this->successResponse(['category' => $category], "Successfully Retrieved");
    }
}
