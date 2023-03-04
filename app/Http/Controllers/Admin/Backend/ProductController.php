<?php

namespace App\Http\Controllers\Admin\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductRequest;
use App\Models\Category;
use App\Models\ProductList;
use App\Models\ProductDetails;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

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

        if ($request->hasFile('image')) {
            $image_name = date('YmdHi') . uniqid() . $request->file('image')->getClientOriginalName();
            $thumbnail_url = 'http://localhost:8000/storage/product_thumbnails/' . $image_name;
            Image::make($request->file('image'))->resize(350, 350)
                ->save(public_path('storage/product_thumbnails/') . $image_name);
        }
        if ($request->hasFile('sub_images')) {
            foreach ($request->file('sub_images') as $key => $file) {
                $image_name = date('YmdHi') . uniqid() . $file->getClientOriginalName();
                $url[] = 'http://localhost:8000/storage/images/' . $image_name;
                Image::make($file)->resize(280, 280)
                    ->save(public_path('storage/images/') . $image_name);
            }
        }

        $product_list = [
            'title' => $request->title,
            'price' => $request->price,
            'special_price' => $request->special_price,
            'image' => $thumbnail_url,
            'category' => $request->category,
            'sub_category' => $request->sub_category,
            'remark' => $request->remark,
            'brand' => $request->brand,
            'product_code' => $request->product_code,
        ];

        //add product list
        $add_product_list = ProductList::create($product_list);

        if ($add_product_list) {
            $product_details = [
                'product_id' => $add_product_list->id,
                'image_one' => array_key_exists(0, $url) ? $url[0] : null, //checks if array index exists
                'image_two' => array_key_exists(1, $url) ? $url[1] : null,
                'image_three' =>  array_key_exists(2, $url) ? $url[2] : null,
                'image_four' => array_key_exists(3, $url) ? $url[3] : null,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'color' => $request->color,
                'size' => $request->size,
            ];

            //add product details
            $add_product_details = ProductDetails::create($product_details);
        }

        $notification = [
            'alert' => $add_product_list && $add_product_details ? 'success' : 'failed',
            'message' => $add_product_list && $add_product_details ?  'Product Succesfully Added' : 'Failed To Add Product',
        ];

        return  redirect(route("product.index"))->with('notification', $notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ProductList $product)
    {

        $product_details = ProductDetails::where('product_id', $product->id)->first();
        $product_info = collect($product)->merge($product_details);
        return view('admin.product.product_details', compact('product_info'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductList $product)
    {
        $category = Category::latest()->get();
        $subcategory = Subcategory::latest()->get();
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

        return view('admin.product.product_edit', compact(['product_info', 'subcategory', 'category']));
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
    public function destroy(ProductList $product)
    {
        $product_details = ProductDetails::where('product_id', $product->id)->first();
        $product_delete = $product->delete();

        if ($product_details && $product_delete)
            $product_details_delete = $product_details->delete();

        $notification = [
            'alert' => $product_delete  ? 'success' : 'failed',
            'message' => $product_delete  ?  'Product Succesfully Deleted' : 'Failed To Delete Product',
        ];
        return  redirect(route("product.index"))->with('notification', $notification);
    }
}
