<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCategoryRequest;
use App\Models\Category;
use App\Models\Subcategory;
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
        $categories = $this->categoryModel->all();
        $categoryDetailsArray = [];
        foreach ($categories as $category) {
            $Sub_category = $this->subcategoryModel->where('category_name', $category->category_name)->get();
            $item = [
                'category_name' => $category->category_name,
                'category_image' => $category->category_image,
                'subcategory_name' => $Sub_category,
            ];

            array_push($categoryDetailsArray, $item);
        }
        return $categoryDetailsArray;
        // return $result ? "successfully retrieved" : "retriving failed";
    }


    public function getAllCategory()
    {
        $category = $this->categoryModel->latest()->get();
        return view("admin.category.category_view", compact('category'));
    }


    public function createCategory()
    {
        return view("admin.category.category_create");
    }


    public function storeCategory(AddCategoryRequest $request)
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

        $notification = [
            'alert' => $Category_create ? 'success' : 'failed',
            'message' => $Category_create ?  'Category Succesfully Created' : 'Failed To Create Category',
        ];

        return  redirect(route("category.list"))->with('notification', $notification);
    }


    public function editCategory(Category $categ_id)
    {
        $category = $categ_id;
        return view("admin.category.category_edit", compact('category'));
    }


    public function updateCategory(AddCategoryRequest $request, Category $categ_id)
    {
        $category_name = $request->category_name;
        $file = $request->file('category_image');
        if ($file) {
            $image_name = date('YmdHi') . $file->getClientOriginalName();
            Image::make($file)->resize(128, 128)
                ->save(public_path('storage/images/') . $image_name);

            //Seperate image name from the url
            $existing_image_path = explode("http://localhost:8000/storage/slider_image/", $categ_id->category_image);
            $stored_image_name = $existing_image_path[1];
            unlink(public_path('storage/slider_image/') . $stored_image_name);
        }
        //storing image url in DB
        $image_url = "http://localhost:8000/storage/images/" . $image_name;
        $Category_update = $categ_id->update([
            'category_name' => $category_name,
            'category_image' => $image_url,
        ]);

        $notification = [
            'alert' => $Category_update ? 'success' : 'failed',
            'message' => $Category_update ?  'Successfully Updated Category' : 'Failed To Update Category',
        ];

        return redirect(route("category.list"))->with('notification', $notification);
    }


    public function deleteCategory(Category $categ_id)
    {
        $existing_image_path = explode("http://localhost:8000/storage/slider_image/", $categ_id->category_image);
        $stored_image_name = $existing_image_path[1];

        $deleted = $categ_id->delete();
        if ($deleted) {
            unlink(public_path('storage/slider_image/') . $stored_image_name);
        }
        $notification = [
            'alert' => $deleted ? 'success' : 'failed',
            'message' => $deleted ?  'Category Successfully Deleted' : 'Failed To Delete Category',
        ];

        return redirect(route('category.list'))->with('notification', $notification);
    }
}
