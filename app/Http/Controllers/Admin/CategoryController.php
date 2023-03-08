<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCategoryRequest;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function allCategory()
    {
        $categories = Category::all();
        $categoryDetailsArray = [];
        foreach ($categories as $category) {
            $Sub_category = Subcategory::where('category_name', $category->category_name)->get();
            $item = [
                'category_name' => $category->category_name,
                'category_image' => $category->category_image,
                'subcategory_name' => $Sub_category,
            ];

            array_push($categoryDetailsArray, $item);
        }
        return $categoryDetailsArray;
    }


    public function getAllCategory()
    {
        $category = Category::latest()->get();
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
        $Category_create = Category::create([
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
            seperate_image_name_and_remove($categ_id->category_image);
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
        //Seperate image name from the url
        seperate_image_name_and_remove($categ_id->category_image);
        $deleted = $categ_id->delete();

        $notification = [
            'alert' => $deleted ? 'success' : 'failed',
            'message' => $deleted ?  'Category Successfully Deleted' : 'Failed To Delete Category',
        ];

        return redirect(route('category.list'))->with('notification', $notification);
    }
}
