<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductDetails;
use App\Models\ProductList;
use Illuminate\Http\Request;

class ProductDetailsController extends Controller
{
    public function productDetails(Request $request)
    {
        $productDetail = ProductDetails::where('product_id', $request->id)->first();
        $productList = ProductList::where('id', $request->id)->first();
        $details = [
            "productDetail" => $productDetail,
            "productList" => $productList,
        ];

        return $details;
    }
}
