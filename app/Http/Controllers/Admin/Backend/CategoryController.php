<?php

namespace App\Http\Controllers\Admin\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCategoryRequest;
use App\Models\Category;
use App\Models\Subcategory;
use App\Services\CategoryService;
use Illuminate\Http\{RedirectResponse};
use Illuminate\View\View;

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
     */
    public function index(): View
    {
        $category = $this->categoryModel->latest()->get();

        return view('admin.category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddCategoryRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $file = $request->file('category_image');
        $category = $this->categoryService->store($file, $validated);
        $notification = $this->notification($category, 'Category Succesfully Created', 'Failed To Create Category');

        return redirect(route('category.index'))->with('notification', $notification);
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
     */
    public function edit(Category $category): View
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AddCategoryRequest $request, Category $category): RedirectResponse
    {
        $validated = $request->validated();
        $file = $request->file('category_image');
        $category = $this->categoryService->update($file, $validated, $category);
        $notification = $this->notification($category, 'Successfully Updated Category', 'Failed To Update Category');

        return redirect(route('category.index'))->with('notification', $notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): RedirectResponse
    {
        seperate_image_name_and_remove($category->category_image);
        $deleted = $category->delete();

        $notification = $this->notification($deleted, 'Category Successfully Deleted', 'Failed To Delete Category');

        return redirect(route('category.index'))->with('notification', $notification);
    }
}
