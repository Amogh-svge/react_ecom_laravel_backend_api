<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCategoryRequest;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    protected Category $categoryModel;
    protected Subcategory $subcategoryModel;

    public function __construct(Category $categoryModel, Subcategory $subcategoryModel)
    {
        $this->categoryModel = $categoryModel;
        $this->subcategoryModel = $subcategoryModel;
    }

    public function allCategory()
    {
        $categories = $this->categoryModel->select(['category_name', 'category_image'])->get();
        $categoryDetailsArray = [];
        foreach ($categories as $category) {
            $Sub_category = $this->subcategoryModel->category($category->category_name)->get();
            $item = [
                'category_name' => $category->category_name,
                'category_image' => $category->category_image,
                'subcategory_name' => $Sub_category,
            ];

            array_push($categoryDetailsArray, $item);
        }

        return $this->successResponse(['category' => $categoryDetailsArray], "Successfully Retrieved");
    }


    public function getAllCategory(): View
    {
        $category = $this->categoryModel->latest()->get();
        return view("admin.category.category_view", compact('category'));
    }


    public function createCategory(): View
    {
        return view("admin.category.category_create");
    }


    public function storeCategory(AddCategoryRequest $request): RedirectResponse
    {
        $category_name = $request->category_name;
        $file = $request->file('category_image');
        if ($file) {
            $image_name = date('YmdHi') . $file->getClientOriginalName();
            Image::make($file)->resize(128, 128)
                ->save(public_path('storage/images/') . $image_name);
        }
        $image_url = "http://localhost:8000/storage/images/" . $image_name;
        $Category_create = $this->categoryModel->create([
            'category_name' => $category_name,
            'category_image' => $image_url,
        ]);

        $notification = $this->notification($Category_create, 'Category Succesfully Created', 'Failed To Create Category');
        return  redirect(route("category.list"))->with('notification', $notification);
    }




    public function editCategory(Category $categ_id): View
    {
        $category = $categ_id;
        return view("admin.category.category_edit", compact('category'));
    }




    public function updateCategory(AddCategoryRequest $request, Category $categ_id): RedirectResponse
    {
        $category_name = $request->category_name;
        $file = $request->file('category_image');
        if ($file) {
            $image_name = date('YmdHi') . $file->getClientOriginalName();
            Image::make($file)->resize(128, 128)
                ->save(public_path('storage/images/') . $image_name);

            seperate_image_name_and_remove($categ_id->category_image);
        }
        //storing image url in DB
        $image_url = "http://localhost:8000/storage/images/" . $image_name;
        $Category_update = $categ_id->update([
            'category_name' => $category_name,
            'category_image' => $image_url,
        ]);

        $notification = $this->notification($Category_update, 'Successfully Updated Category', 'Failed To Update Category');
        return redirect(route("category.list"))->with('notification', $notification);
    }




    public function deleteCategory(Category $categ_id): RedirectResponse
    {
        seperate_image_name_and_remove($categ_id->category_image);
        $deleted = $categ_id->delete();

        $notification = $this->notification($deleted, 'Category Successfully Deleted', 'Failed To Delete Category');
        return redirect(route('category.list'))->with('notification', $notification);
    }
}
