<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\ProductList;
use Illuminate\Http\Request;

class ProductListController extends Controller
{
    protected ProductList $ProductListModel;

    public function __construct(ProductList $ProductListModel)
    {
        $this->ProductListModel = $ProductListModel;
    }

    public function productList()
    {
        $product = $this->ProductListModel->all();
        return $this->successResponse($product, "Successfully Retrieved");
    }

    public function productListByRemark(Request $request)
    {
        $Remark = $request->remark;
        return $this->ProductListModel->where('remark', $Remark)->get();
    }

    public function productListByCategory(Request $request)
    {
        $Category = $request->category;
        $Product_list = $this->ProductListModel->category($Category)->get();
        return $this->successResponse(ProductResource::collection($Product_list), "Successfully Retrived");
    }

    public function productListBySubCategory(Request $request)
    {
        $Category = $request->category;
        $Sub_category = $request->subcategory;
        return  $this->ProductListModel->category($Category)->subCategory($Sub_category)->get();
    }

    public function searchProducts(Request $request)
    {

        $SearchQuery = $request->keyword;
        return $Product_list = $this->ProductListModel
            ->where('title', 'LIKE', "%{$SearchQuery}%")
            ->orWhere('brand', 'LIKE', "%{$SearchQuery}%")
            ->orWhere('category', 'LIKE', "%{$SearchQuery}%")->get();
    }

    public function relatedProducts(Request $request)
    {
        $product_id = $request->id;
        $relatedProduct = $request->subcategory;
        return $this->ProductListModel->subCategory($relatedProduct)
            ->whereNot('id', $product_id)
            ->latest()->limit(6)->get();
    }
}
