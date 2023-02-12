<?php

namespace App\Http\Controllers\Admin\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sub_categories = Subcategory::latest()->get();
        return view('admin.subcategory.subcategory_view', compact('sub_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.subcategory.subcategory_create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubCategoryRequest $request)
    {
        $inputs = [
            'category_name' => $request->category_name,
            'subcategory_name' => $request->subcategory_name,
        ];

        $subcategory_create = Subcategory::create($inputs);
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
    public function edit($id)
    {
        $categories = Category::all();
        $subcategory = Subcategory::find($id);
        return view('admin.subcategory.subcategory_edit', compact(['subcategory', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubCategoryRequest $request, $id)
    {
        $inputs = [
            'category_name' => $request->category_name,
            'subcategory_name' => $request->subcategory_name,
        ];

        $subcategory = Subcategory::find($id);
        $subcategory_update = $subcategory->update($inputs);

        $notification = [
            'alert' => $subcategory_update ? 'success' : 'failed',
            'message' => $subcategory_update ?  'Sub_Category Succesfully Updated' : 'Failed To Update SubCategory',
        ];

        return  redirect(route("subcategory.index"))->with('notification', $notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcategory = Subcategory::find($id);
        $deleted = $subcategory->delete();

        $notification = [
            'alert' => $deleted ? 'success' : 'failed',
            'message' => $deleted ?  'Sub_Category Successfully Deleted' : 'Failed To Delete Sub_Category',
        ];

        return redirect(route('subcategory.index'))->with('notification', $notification);
    }
}
