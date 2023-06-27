<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Favourite;
use App\Models\ProductList;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    protected ProductList $productList;
    protected Favourite $favourite;

    public function __construct(ProductList $productList, Favourite $favourite)
    {
        $this->productList = $productList;
        $this->favourite = $favourite;
    }

    public function addFavourite(Request $request)
    {
        $product_code = $request->product_code;
        $email = $request->email;
        $Product_details = $this->productList->where('product_code', $product_code)->first();

        $result = $this->favourite->create([
            'email' => $email,
            'image' => $Product_details->image,
            'product_name' => $Product_details->title,
            'product_code' => $product_code,
        ]);

        return $result;
    }

    public function favouriteList(Request $request)
    {
        $email = $request->email;
        $favourite_list = $this->favourite->where('email', $email)->get();

        return $favourite_list;
    }

    public function favouriteRemove(Request $request)
    {
        $email = $request->email;
        $product_code = $request->product_code;

        $remove_product = $this->favourite->where('product_code', $product_code)->where('email', $email)->delete();
        return $remove_product;
    }
}
