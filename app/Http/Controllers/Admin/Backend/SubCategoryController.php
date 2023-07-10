<?php

namespace App\Http\Controllers\Admin\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

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
    public function index(): View
    {
        $sub_categories = $this->subcategoryModel->with('category:category_name')->get();

        return view('admin.subcategory.index', compact('sub_categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = $this->categoryModel->all();

        return view('admin.subcategory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(SubCategoryRequest $request): RedirectResponse
    {
        $subcategory_create = $this->subcategoryModel->create($request->validated());

        $notification = $this->notification($subcategory_create, 'Sub_Category Successfully Created', 'Failed To Create Sub_Category');

        return redirect(route('subcategory.index'))->with('notification', $notification);
    }

    /**
     * Display the specified resource.
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
    public function edit($id): View
    {
        $categories = $this->categoryModel->all();
        $subcategory = $this->subcategoryModel->findOrFail($id);

        return view('admin.subcategory.edit', compact(['subcategory', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return void
     */
    public function update(SubCategoryRequest $request, int $id): RedirectResponse
    {
        $inputs = [
            'category_name' => $request->category_name,
            'subcategory_name' => $request->subcategory_name,
        ];

        $subcategory = $this->subcategoryModel->findOrFail($id);
        $subcategory_update = $subcategory->update($inputs);

        $notification = $this->notification($subcategory_update, 'Sub_Category Successfully Updated', 'Failed To Update Sub_Category');

        return redirect(route('subcategory.index'))->with('notification', $notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        $subcategory = $this->subcategoryModel->findOrFail($id);
        $deleted = $subcategory->delete();

        $notification = $this->notification($deleted, 'Sub_Category Successfully Deleted', 'Failed To Delete Sub_Category');

        return redirect(route('subcategory.index'))->with('notification', $notification);
    }
}
