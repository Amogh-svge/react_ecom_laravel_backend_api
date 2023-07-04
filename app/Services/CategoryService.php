<?php

namespace App\Services;

use App\Http\Resources\SubCategoryResource;
use App\Models\{Category, Subcategory};
use Intervention\Image\Facades\Image;


class CategoryService
{
    protected Category $categoryModel;
    protected Subcategory $subcategoryModel;

    public function __construct(Category $categoryModel, Subcategory $subcategoryModel)
    {
        $this->categoryModel = $categoryModel;
        $this->subcategoryModel = $subcategoryModel;
    }


    public function allCategory(object $categories): array
    {
        $categoryDetails = $categories->map(function ($category) {
            $sub_category = $this->subcategoryModel->category($category->category_name)->get();
            return [
                'category_name' => $category->category_name,
                'category_image' => $category->category_image,
                'subcategory_name' => SubCategoryResource::collection($sub_category),
            ];
        });

        return $categoryDetails;
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
