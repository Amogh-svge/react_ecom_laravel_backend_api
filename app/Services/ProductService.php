<?php

namespace App\Services;

use App\Models\ProductDetails;
use App\Models\ProductList;
use Illuminate\Support\Arr;
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


    public function createProductList(array $validated, string $thumbnail_url): object
    {
        $product_list = Arr::except($validated, ['short_description', 'long_description', 'image', 'size', 'color', 'sub_images']);
        $product_list += ['image' => $thumbnail_url];
        $productList = $this->ProductListModel->create($product_list);
        return $productList;
    }


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
}
