<?php

namespace App\Http\Controllers\Admin\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductRequest;
use App\Models\Category;
use App\Models\ProductList;
use App\Models\ProductDetails;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = ProductList::latest()->get();
        return view("admin.product.product_view", compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::latest()->get();
        $subcategory = Subcategory::latest()->get();
        return view("admin.product.product_create", compact(['category', 'subcategory']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddProductRequest $request)
    {
        $product_list = [
            'title' => $request->title,
            'price' => $request->price,
            'special_price' => $request->special_price,
            'image' => $request->image,
            'category' => $request->category,
            'sub_category' => $request->sub_category,
            'remark' => $request->remark,
            'brand' => $request->brand,
            'product_code' => $request->product_code,
        ];
        $add_product_list = ProductList::create($product_list);

        $product_details = [
            'product_id' => $add_product_list->id,
            'image_one' => 'http://localhost:8000/storage/images/202302050725dell7000.jpeg',
            'image_two' => 'http://localhost:8000/storage/images/202302050725dell7000.jpeg',
            'image_three' => 'http://localhost:8000/storage/images/202302050725dell7000.jpeg',
            'image_four' => 'http://localhost:8000/storage/images/202302050725dell7000.jpeg',
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'color' => $request->color,
            'size' => $request->size,
        ];
        if ($add_product_list) {
            $create_product_details = ProductDetails::create($product_details);
            return redirect(route('product.index'));
        } else return "product details addition failed";

        // $add_product = ProductList::create([]);

        // $notification = [
        //     'alert' => $Category_create ? 'success' : 'failed',
        //     'message' => $Category_create ?  'Product Succesfully Added' : 'Failed To Add Product',
        // ];

        // return  redirect(route("product.index"))->with('notification', $notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return view('admin.product.product_create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductList $product)
    {
        // return $product;
        $product_details = ProductDetails::find($product->id);
        $product_info = [
            'title' => $product->title,
            'price' => $product->price,
            'special_price' => $product->special_price,
            'category' => $product->category,
            'sub_category' => $product->sub_category,
            'remark' => $product->remark,
            'brand' => $product->brand,
            'rating' => $product->rating,
            'product_code' => $product->product_code,
            'image_one' =>  $product_details->image_one,
            'image_two' =>  $product_details->image_two,
            'image_three' =>  $product_details->image_three,
            'image_four' =>  $product_details->image_four,
            'short_description' =>  $product_details->short_description,
            'long_description' =>  $product_details->long_description,
            'color' =>  $product_details->color,
            'size' =>  $product_details->size,
        ];

        return view('admin.product.product_edit', compact('product_info'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
