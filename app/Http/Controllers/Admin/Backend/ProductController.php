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
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = ProductList::latest()->get();
        return view("admin.product.product_view", compact('products'));
    }


    public function create()
    {
        $category = Category::latest()->get();
        $subcategory = Subcategory::latest()->get();
        return view("admin.product.product_create", compact(['category', 'subcategory']));
    }


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


    public function show(ProductList $product)
    {
        $product_details = ProductDetails::where('product_id', $product->id)->first();
        $product_info = collect($product)->merge($product_details);
        return view('admin.product.product_details', compact('product_info'));
    }


    public function edit(ProductList $product)
    {
        $category = Category::latest()->select(['category_name'])->get();
        $subcategory = Subcategory::latest()->select(['subcategory_name'])->get();
        $product_details = ProductDetails::where('product_id', $product->id)->first();
        $product_info = [
            'id' => $product->id,
            'product_details_id' => $product_details->id,
            'title' => $product->title,
            'price' => $product->price,
            'special_price' => $product->special_price,
            'category' => $product->category,
            'sub_category' => $product->sub_category,
            'remark' => $product->remark,
            'brand' => $product->brand,
            'rating' => $product->rating,
            'product_code' => $product->product_code,
            'image_one' =>  $product_details->image_one ? $product_details->image_one : null,
            'image_two' =>  $product_details->image_two ? $product_details->image_two : null,
            'image_three' =>  $product_details->image_three ? $product_details->image_three : null,
            'image_four' =>  $product_details->image_four ? $product_details->image_four : null,
            'short_description' =>  $product_details->short_description,
            'long_description' =>  $product_details->long_description,
            'color' =>  $product_details->color,
            'size' =>  $product_details->size,
        ];

        return view('admin.product.product_edit', compact(['product_info', 'subcategory', 'category']));
    }


    public function update(Request $request, ProductList $product)
    {

        $productDetail = ProductDetails::where('product_id', $product->id)->first();

        if ($request->hasFile('image')) {
            $image_name = date('YmdHi') . uniqid() . $request->file('image')->getClientOriginalName();
            $thumbnail_url = 'http://localhost:8000/storage/product_thumbnails/' . $image_name;
            Image::make($request->file('image'))->resize(350, 350)
                ->save(public_path('storage/product_thumbnails/') . $image_name);

            //Seperate image name from the url
            $stored_image_name = Str::after($product->image, "http://localhost:8000/storage/product_thumbnails/");
        }

        $url = array(); //global array
        if ($request->hasFile('sub_images')) {
            foreach ($request->file('sub_images') as $key => $file) {
                $image_name = date('YmdHi') . uniqid() . $file->getClientOriginalName();
                global $url;
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

        //update product list
        $update_product_list = $product->update($product_list);

        if ($update_product_list) {
            $existing_image_path = [
                'first_image' => $productDetail->image_one ? Str::after($productDetail->image_one, "http://localhost:8000/storage/images/") : null,
                'second_image' => $productDetail->image_two ? Str::after($productDetail->image_two, "http://localhost:8000/storage/images/") : null,
                'third_image' => $productDetail->image_three ? Str::after($productDetail->image_three, "http://localhost:8000/storage/images/") : null,
            ];

            $existing_image_path['first_image'] != null ? unlink(public_path('storage/images/') .  $existing_image_path['first_image']) : null;
            $existing_image_path['second_image'] != null ? unlink(public_path('storage/images/') .  $existing_image_path['second_image']) : null;
            $existing_image_path['third_image'] != null ? unlink(public_path('storage/images/') .  $existing_image_path['third_image']) : null;

            $product_details = [
                'product_id' => $product->id,
                'image_one' => array_key_exists(0, $url) ? $url[0] : null, //checks if array index exists
                'image_two' => array_key_exists(1, $url) ? $url[1] : null,
                'image_three' =>  array_key_exists(2, $url) ? $url[2] : null,
                'image_four' => array_key_exists(3, $url) ? $url[3] : null,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'color' => $request->color,
                'size' => $request->size,
            ];

            //update product details
            $update_product_details = $productDetail->update($product_details);
        }


        $notification = [
            'alert' => $update_product_list && $update_product_details ? 'success' : 'failed',
            'message' => $update_product_list && $update_product_details ?  'Product Succesfully Updated' : 'Failed To Update Product',
        ];

        return  redirect(route("product.index"))->with('notification', $notification);
    }



    public function destroy(ProductList $product)
    {
        $productDetail = ProductDetails::where('product_id', $product->id)->first();
        $product_delete = $product->delete();

        //Seperate image name from the url
        $stored_image_name = Str::after($product->image, "http://localhost:8000/storage/product_thumbnails/");
        unlink(public_path('storage/product_thumbnails/') . $stored_image_name);

        if ($productDetail && $product_delete)
            $existing_image_path = [
                'first_image' => $productDetail->image_one ? Str::after($productDetail->image_one, "http://localhost:8000/storage/images/") : null,
                'second_image' => $productDetail->image_two ? Str::after($productDetail->image_two, "http://localhost:8000/storage/images/") : null,
                'third_image' => $productDetail->image_three ? Str::after($productDetail->image_three, "http://localhost:8000/storage/images/") : null,
            ];

        $existing_image_path['first_image'] != null ? unlink(public_path('storage/images/') .  $existing_image_path['first_image']) : null;
        $existing_image_path['second_image'] != null ? unlink(public_path('storage/images/') .  $existing_image_path['second_image']) : null;
        $existing_image_path['third_image'] != null ? unlink(public_path('storage/images/') .  $existing_image_path['third_image']) : null;


        $product_details_delete = $productDetail->delete();
        $notification = [
            'alert' => $product_delete && $product_details_delete  ? 'success' : 'failed',
            'message' => $product_delete && $product_details_delete  ?  'Product Succesfully Deleted' : 'Failed To Delete Product',
        ];
        return  redirect(route("product.index"))->with('notification', $notification);
    }
}
