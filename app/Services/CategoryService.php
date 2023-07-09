<?php

namespace App\Services;

use App\Models\{Category, Subcategory};
use App\Repository\CategoryRepository;
use Intervention\Image\Facades\Image;


class CategoryService
{
    protected Category $categoryModel;
    protected Subcategory $subcategoryModel;
    protected CategoryRepository $categoryRepository;

    public function __construct(Category $categoryModel, Subcategory $subcategoryModel, CategoryRepository $categoryRepository)
    {
        $this->categoryModel = $categoryModel;
        $this->subcategoryModel = $subcategoryModel;
        $this->categoryRepository = $categoryRepository;
    }


    public function all(): object
    {
        return $query = $this->categoryRepository->all();
    }


    public function saveCategoryImage($file): string
    {
        $image_name = date('YmdHi') . $file->getClientOriginalName();
        Image::make($file)->resize(128, 128)
            ->save(public_path('storage/images/') . $image_name);
        return $image_name;
    }


    public function store($file, array $validated): object
    {
        if ($file)
            $image_name = $this->saveCategoryImage($file);

        $image_url = "http://localhost:8000/storage/images/" . $image_name;
        $validated['category_image'] = $image_url;
        $category = $this->categoryModel->create($validated);
        return $category;
    }


    public function update($file, array $validated, object $category): object
    {
        if ($file)
            $image_name = $this->saveCategoryImage($file);

        seperate_image_name_and_remove($category->category_image);
        $image_url = "http://localhost:8000/storage/images/" . $image_name;
        $validated['category_image'] = $image_url;
        $this->categoryModel->update($validated);
        return $category;
    }
}
