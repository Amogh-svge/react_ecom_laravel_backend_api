<?php

namespace App\Services;

use App\Models\ProductDetails;
use App\Models\ProductList;
use Illuminate\Support\{Arr, Str};
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class ProductService
{
    protected ProductList $ProductListModel;
    protected ProductDetails $ProductDetailsModel;

    /**
     * @param ProductList $ProductListModel
     * @param ProductDetails $ProductDetailsModel
     */
    public function __construct(ProductList $ProductListModel, ProductDetails $ProductDetailsModel)
    {
        $this->ProductListModel = $ProductListModel;
        $this->ProductDetailsModel = $ProductDetailsModel;
    }


    /**
     * Generate Image for thumbnail and returns its url
     */
    public function getThumbnailUrl(object $request): string
    {
        if ($request->hasFile('image')) {
            $image_name = date('YmdHi') . uniqid() . $request->file('image')->getClientOriginalName();
            $thumbnail_url = 'http://localhost:8000/storage/product_thumbnails/' . $image_name;
            Image::make($request->file('image'))->resize(350, 250)
                ->save(public_path('storage/product_thumbnails/') . $image_name);
            return  $thumbnail_url;
        }
    }


    /**
     * Generate sub-Image and returns its url
     */
    public function getSubImageUrl(object $request): array
    {
        if ($request->hasFile('sub_images')) {
            foreach ($request->file('sub_images') as $file) {
                $image_name = date('YmdHi') . uniqid() . $file->getClientOriginalName();
                $url[] = 'http://localhost:8000/storage/images/' . $image_name;
                Image::make($file)->resize(280, 230)
                    ->save(public_path('storage/images/') . $image_name);
            }
            return $url;
        }
    }


    /**
     * create product list
     */
    public function createProductList(array $validated, string $thumbnail_url): object
    {
        $product_list = Arr::except($validated, ['short_description', 'long_description', 'image', 'size', 'color', 'sub_images']);
        $product_list += ['image' => $thumbnail_url];
        $productList = $this->ProductListModel->create($product_list);
        return $productList;
    }


    /**
     * create product details
     */
    public function createProductDetails(object $productList, array $validated, array $url): object
    {
        if ($productList) {
            $product_details =  Arr::only($validated, ['short_description', 'long_description', 'color', 'size']);
            $product_details += [
                'product_id' => $productList->id,
                'image_one' => array_key_exists(0, $url) ? $url[0] : null, //checks if array index exists
                'image_two' => array_key_exists(1, $url) ? $url[1] : null,
                'image_three' =>  array_key_exists(2, $url) ? $url[2] : null,
                'image_four' => array_key_exists(3, $url) ? $url[3] : null,
            ];
            $productDetails = $this->ProductDetailsModel->create($product_details);
            return $productDetails;
        }
    }


    /**
     * update product list
     */
    public function updateProductList(array $validated, string $thumbnail_url, object $product): object
    {
        $product_list = Arr::except($validated, ['short_description', 'long_description', 'image', 'size', 'color', 'sub_images']);
        $product_list += ['image' => $thumbnail_url];
        $product->update($product_list);
        return $product;
    }


    /**
     * update product details
     */
    public function updateProductDetails(object $productList, array $validated, array $url, object $productDetail, object $product): object
    {
        if ($productList) {
            $existing_image_path = [
                $productDetail->image_one ? Str::after($productDetail->image_one, "http://localhost:8000/storage/images/") : null,
                $productDetail->image_two ? Str::after($productDetail->image_two, "http://localhost:8000/storage/images/") : null,
                $productDetail->image_three ? Str::after($productDetail->image_three, "http://localhost:8000/storage/images/") : null,
            ];

            //separate image name and unlink
            unlink_image_names($existing_image_path); //helper

            $product_details =  Arr::only($validated, ['short_description', 'long_description', 'color', 'size']);
            $product_details += [
                'product_id' => $product->id,
                'image_one' => array_key_exists(0, $url) ? $url[0] : null, //checks if array index exists
                'image_two' => array_key_exists(1, $url) ? $url[1] : null,
                'image_three' =>  array_key_exists(2, $url) ? $url[2] : null,
                'image_four' => array_key_exists(3, $url) ? $url[3] : null,
            ];
            //update product details
            $productDetails = $productDetail->update($product_details);
            return $productDetail;
        }
    }


    /**
     * store product list and detail
     */
    public function store(object $request): bool
    {
        $validated = $request->validated();
        $thumbnail_url = $this->getThumbnailUrl($request);
        $url = $this->getSubImageUrl($request);

        DB::beginTransaction();
        $productList = $this->createProductList($validated, $thumbnail_url);
        $productDetails = $this->createProductDetails($productList, $validated, $url);
        $productList && $productDetails ? DB::commit() : DB::rollback();
        return $productList && $productDetails ? true : false;
    }


    /**
     * Edit product
     */
    public function edit(object $product): array
    {
        $product_details = ProductDetails::where('product_id', $product->id)->first();
        $productDetails = $product_details->only(['color', 'size', 'long_description', 'short_description']);
        $product_info = $product->toArray() + $productDetails;
        $product_info += [
            'product_details_id' => $product_details->id,
            'image_one' =>  $product_details->image_one ? $product_details->image_one : null,
            'image_two' =>  $product_details->image_two ? $product_details->image_two : null,
            'image_three' =>  $product_details->image_three ? $product_details->image_three : null,
            'image_four' =>  $product_details->image_four ? $product_details->image_four : null,
        ];
        return $product_info;
    }


    /**
     * update product and product detail
     */
    public function update(object $request, object $product): bool
    {
        $validated = $request->validated();
        $productDetail = ProductDetails::where('product_id', $product->id)->firstOrFail();

        $thumbnail_url = $this->getThumbnailUrl($request);
        seperate_thumbnail_image_name_and_remove($product->image);   //Seperate image name from the url and unlink from storage
        $url = $this->getSubImageUrl($request);

        DB::beginTransaction();
        $productList = $this->updateProductList($validated, $thumbnail_url, $product);
        $productDetails = $this->updateProductDetails($productList, $validated, $url, $productDetail, $product);
        $productList && $productDetails ? DB::commit() : DB::rollback();
        return $productList && $productDetails ? true : false;
    }


    /**
     * delete product and product detail
     */
    public function delete(object $product)
    {
        $productDetail = ProductDetails::where('product_id', $product->id)->first();
        DB::beginTransaction();
        $deleteProduct = $product->delete();

        //Seperate image name from the url
        seperate_thumbnail_image_name_and_remove($product->image);

        if ($productDetail && $deleteProduct)
            $existing_image_path = [
                $productDetail->image_one ? Str::after($productDetail->image_one, "http://localhost:8000/storage/images/") : null,
                $productDetail->image_two ? Str::after($productDetail->image_two, "http://localhost:8000/storage/images/") : null,
                $productDetail->image_three ? Str::after($productDetail->image_three, "http://localhost:8000/storage/images/") : null,
            ];

        //separate image name and unlink
        unlink_image_names($existing_image_path); //helper

        $deleteProductDetails = $productDetail->delete();
        $deleteProduct && $deleteProductDetails ? DB::commit() : DB::rollback();
        return $deleteProduct && $deleteProductDetails ? true : false;
    }
}
