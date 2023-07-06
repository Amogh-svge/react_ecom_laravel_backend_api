<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\ProductList;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductListController extends Controller
{
    protected ProductList $ProductListModel;
    protected Category $CategoryModel;
    protected ProductRepository $productRepository;
    protected CategoryRepository $categoryRepository;

    public function __construct(ProductList $ProductListModel, Category $CategoryModel, ProductRepository $productRepository, CategoryRepository $categoryRepository)
    {
        $this->ProductListModel = $ProductListModel;
        $this->CategoryModel = $CategoryModel;
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }


    public function productList(): JsonResponse
    {
        $product = request('viewAll', true) == false ?
            $this->ProductListModel->latest()->limit(10)->get() :
            $this->ProductListModel->paginate(10);

        return $this->successResponse(['products' => ProductResource::collection($product)], "Successfully Retrieved");
    }


    public function productListByRemark(Request $request)
    {
        $product =  $this->productRepository->getByRemark($request->remark);
        return $this->successResponse(['products' => ProductResource::collection($product)], "Successfully Retrieved");
    }


    public function productListByCategory(Request $request)
    {
        $category_name = $request->category;
        $category = $this->categoryRepository->firstCategoryByName($category_name);
        dd($category);
        $Product_list = $this->ProductListModel->getByCategory($category->id)->get();
        return $this->successResponse(['products' => ProductResource::collection($Product_list)], "Successfully Retrived");
    }


    public function productListBySubCategory(Request $request)
    {
        $Category = $request->category;
        $Sub_category = $request->subcategory;
        return  $this->ProductListModel->getByCategory($Category)->subCategory($Sub_category)->get();
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
