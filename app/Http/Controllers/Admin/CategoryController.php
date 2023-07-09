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


    public function index(): JsonResponse
    {
        $category = $this->categoryService->all();
        return $category->isNotEmpty() ?
            $this->successResponse(['category' => $category], "Successfully Retrieved") :
            $this->successResponse(['category' => []], "No Results Found");
    }
}
