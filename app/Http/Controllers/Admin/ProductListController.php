<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductList;
use Illuminate\Http\Request;

class ProductListController extends Controller
{
    public function productListByRemark(Request $request)
    {
        $Remark = $request->remark;
        return $Product_list = ProductList::where('remark', $Remark)->get();
    }

    public function productListByCategory(Request $request)
    {
        $Category = $request->category;
        return $Product_list = ProductList::where('category', $Category)->get();
    }

    public function productListBySubCategory(Request $request)
    {
        $Category = $request->category;
        $Sub_category = $request->subcategory;
        return $Product_list = ProductList::where('category', $Category)->where('sub_category', $Sub_category)->get();
    }

    public function searchProducts(Request $request)
    {

        $SearchQuery = $request->keyword;
        return $Product_list = ProductList::where('title', 'LIKE', "%{$SearchQuery}%")
            ->orWhere('brand', 'LIKE', "%{$SearchQuery}%")
            ->orWhere('category', 'LIKE', "%{$SearchQuery}%")->get();
    }
    public function relatedProducts(Request $request)
    {
        $product_id = $request->id;
        $relatedProduct = $request->subcategory;
        return $Product_list = ProductList::where('sub_category', $relatedProduct)
            ->whereNot('id', $product_id)
            ->orderBy('id', 'desc')->limit(6)->get();
    }
}
