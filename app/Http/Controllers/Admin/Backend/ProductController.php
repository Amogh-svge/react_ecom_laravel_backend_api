<?php

namespace App\Http\Controllers\Admin\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductRequest;
use App\Models\Category;
use App\Models\ProductList;
use App\Models\ProductDetails;
use App\Models\Subcategory;
use App\Services\ProductService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    protected ProductList $ProductListModel;
    protected Category $categoryModel;
    protected Subcategory $subcategoryModel;
    protected ProductService $productService;

    public function __construct(ProductList $ProductListModel, Category $categoryModel, Subcategory $subcategoryModel, ProductService $productService)
    {
        $this->ProductListModel = $ProductListModel;
        $this->categoryModel = $categoryModel;
        $this->subcategoryModel = $subcategoryModel;
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->ProductListModel->latest()->get();
        return view("admin.product.product_view", compact('products'));
    }


    public function create()
    {
        $category = $this->categoryModel->latest()->get();
        $subcategory = $this->subcategoryModel->latest()->get();
        return view("admin.product.product_create", compact(['category', 'subcategory']));
    }


    public function store(AddProductRequest $request)
    {
        $validated = $request->validated();
        $thumbnail_url = $this->productService->getThumbnailUrl($request);
        $url = $this->productService->getSubImageUrl($request);

        DB::beginTransaction();
        $productList = $this->productService->createProductList($validated, $thumbnail_url);
        $productDetails = $this->productService->createProductDetails($productList, $validated, $url);
        $productList && $productDetails ? DB::commit() : DB::rollback();

        $notification = [
            'alert' => $productList && $productDetails ? 'success' : 'failed',
            'message' => $productList && $productDetails ?  'Product Succesfully Added' : 'Failed To Add Product',
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
        $category = $this->categoryModel->pluck('category_name');
        $subcategory = $this->subcategoryModel->pluck('subcategory_name');
        $product_info = $this->productService->edit($product);
        return view('admin.product.product_edit', compact(['product_info', 'subcategory', 'category']));
    }


    public function update(Request $request, ProductList $product)
    {

        $productDetail = ProductDetails::where('product_id', $product->id)->first();

        if ($request->hasFile('image')) {
            $image_name = date('YmdHi') . uniqid() . $request->file('image')->getClientOriginalName();
            $thumbnail_url = 'http://localhost:8000/storage/product_thumbnails/' . $image_name;
            Image::make($request->file('image'))->resize(350, 250)
                ->save(public_path('storage/product_thumbnails/') . $image_name);

            //Seperate image name from the url and unlink from storage
            seperate_thumbnail_image_name_and_remove($product->image);
        }

        $url = array(); //global array  
        if ($request->hasFile('sub_images')) {
            foreach ($request->file('sub_images') as $key => $file) {
                $image_name = date('YmdHi') . uniqid() . $file->getClientOriginalName();
                global $url;
                $url[] = 'http://localhost:8000/storage/images/' . $image_name;
                Image::make($file)->resize(280, 230)
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
                $productDetail->image_one ? Str::after($productDetail->image_one, "http://localhost:8000/storage/images/") : null,
                $productDetail->image_two ? Str::after($productDetail->image_two, "http://localhost:8000/storage/images/") : null,
                $productDetail->image_three ? Str::after($productDetail->image_three, "http://localhost:8000/storage/images/") : null,
            ];

            //separate image name and unlink
            unlink_image_names($existing_image_path); //helper

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
        seperate_thumbnail_image_name_and_remove($product->image);

        if ($productDetail && $product_delete)
            $existing_image_path = [
                $productDetail->image_one ? Str::after($productDetail->image_one, "http://localhost:8000/storage/images/") : null,
                $productDetail->image_two ? Str::after($productDetail->image_two, "http://localhost:8000/storage/images/") : null,
                $productDetail->image_three ? Str::after($productDetail->image_three, "http://localhost:8000/storage/images/") : null,
            ];

        //separate image name and unlink
        unlink_image_names($existing_image_path); //helper

        $product_details_delete = $productDetail->delete();
        $notification = [
            'alert' => $product_delete && $product_details_delete  ? 'success' : 'failed',
            'message' => $product_delete && $product_details_delete  ?  'Product Succesfully Deleted' : 'Failed To Delete Product',
        ];
        return  redirect(route("product.index"))->with('notification', $notification);
    }
}
