<?php

namespace App\Http\Controllers\Admin\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCategoryRequest;
use App\Models\Category;
use App\Models\Subcategory;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = $this->categoryModel->latest()->get();
        return view("admin.category.index", compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.category.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validated();
        $file = $request->file('category_image');
        $category = $this->categoryService->store($file, $validated);
        $notification = $this->notification($category, 'Category Succesfully Created', 'Failed To Create Category');
        return  redirect(route("category.index"))->with('notification', $notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view("admin.category.edit", compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AddCategoryRequest $request, Category $category)
    {
        $category_name = $request->category_name;
        $file = $request->file('category_image');
        if ($file) {
            $image_name = date('YmdHi') . $file->getClientOriginalName();
            Image::make($file)->resize(128, 128)
                ->save(public_path('storage/images/') . $image_name);

            seperate_image_name_and_remove($category->category_image);
        }
        //storing image url in DB
        $image_url = "http://localhost:8000/storage/images/" . $image_name;
        $Category_update = $category->update([
            'category_name' => $category_name,
            'category_image' => $image_url,
        ]);

        $notification = $this->notification($Category_update, 'Successfully Updated Category', 'Failed To Update Category');
        return redirect(route("category.index"))->with('notification', $notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        seperate_image_name_and_remove($category->category_image);
        $deleted = $category->delete();

        $notification = $this->notification($deleted, 'Category Successfully Deleted', 'Failed To Delete Category');
        return redirect(route('category.index'))->with('notification', $notification);
    }
}
