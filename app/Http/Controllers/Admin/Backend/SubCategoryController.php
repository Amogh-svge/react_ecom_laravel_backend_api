<?php

namespace App\Http\Controllers\Admin\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\Models\Category;
use App\Models\Subcategory;

class SubCategoryController extends Controller
{
    protected Category $categoryModel;
    protected Subcategory $subcategoryModel;

    public function __construct(Category $categoryModel, Subcategory $subcategoryModel)
    {
        $this->categoryModel = $categoryModel;
        $this->subcategoryModel = $subcategoryModel;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sub_categories = $this->subcategoryModel->latest()->get();
        return view('admin.subcategory.subcategory_view', compact('sub_categories'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryModel->all();
        return view('admin.subcategory.subcategory_create', compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     * @param SubCategoryRequest $request
     * @return void
     */
    public function store(SubCategoryRequest $request)
    {
        $inputs = [
            'category_name' => $request->category_name,
            'subcategory_name' => $request->subcategory_name,
        ];

        $subcategory_create = $this->subcategoryModel->create($inputs);
        $notification = [
            'alert' => $subcategory_create ? 'success' : 'failed',
            'message' => $subcategory_create ?  'Sub_Category Succesfully Created' : 'Failed To Create SubCategory',
        ];

        return  redirect(route("subcategory.index"))->with('notification', $notification);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show(int $id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = $this->categoryModel->all();
        $subcategory = $this->subcategoryModel->find($id);
        return view('admin.subcategory.subcategory_edit', compact(['subcategory', 'categories']));
    }


    /**
     * Update the specified resource in storage.
     * @param SubCategoryRequest $request
     * @param integer $id
     * @return void
     */
    public function update(SubCategoryRequest $request, int $id)
    {
        $inputs = [
            'category_name' => $request->category_name,
            'subcategory_name' => $request->subcategory_name,
        ];

        $subcategory = $this->subcategoryModel->find($id);
        $subcategory_update = $subcategory->update($inputs);

        $notification = [
            'alert' => $subcategory_update ? 'success' : 'failed',
            'message' => $subcategory_update ?  'Sub_Category Succesfully Updated' : 'Failed To Update SubCategory',
        ];

        return  redirect(route("subcategory.index"))->with('notification', $notification);
    }


    /**
     * Remove the specified resource from storage.
     * @param  integer  $id
     */
    public function destroy(int $id)
    {
        $subcategory = $this->subcategoryModel->find($id);
        $deleted = $subcategory->delete();

        $notification = [
            'alert' => $deleted ? 'success' : 'failed',
            'message' => $deleted ?  'Sub_Category Successfully Deleted' : 'Failed To Delete Sub_Category',
        ];

        return redirect(route('subcategory.index'))->with('notification', $notification);
    }
}
