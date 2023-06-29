<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductDetails;
use App\Models\ProductList;
use Illuminate\Http\Request;

class ProductDetailsController extends Controller
{
    public function productDetails(Request $request, ProductDetails $ProductDetails, ProductList $ProductList)
    {
        $productDetail = $ProductDetails->where('product_id', $request->id)->firstOrFail();
        $productList = $ProductList->getById($request->id)->firstOrFail();
        $details = [
            "productDetail" => $productDetail,
            "productList" => $productList,
        ];

        return $details;
    }
}
