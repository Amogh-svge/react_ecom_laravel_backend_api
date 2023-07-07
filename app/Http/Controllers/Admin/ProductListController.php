<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\ProductList;
use App\Repository\ProductRepository;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductListController extends Controller
{
    protected ProductList $ProductListModel;
    protected Category $CategoryModel;
    protected ProductRepository $productRepository;
    protected ProductService $productService;

    public function __construct(ProductList $ProductListModel, Category $CategoryModel, ProductRepository $productRepository, ProductService $productService)
    {
        $this->ProductListModel = $ProductListModel;
        $this->CategoryModel = $CategoryModel;
        $this->productRepository = $productRepository;
        $this->productService = $productService;
    }


    public function productList(): JsonResponse
    {
        $product_list = request('viewAll', true) == false ?
            $this->ProductListModel->latest()->limit(10)->get() :
            $this->ProductListModel->paginate(10);

        return $product_list->isNotEmpty() ?
            $this->successResponse(['products' => ProductResource::collection($product_list)], "Successfully Retrived") :
            $this->successResponse(['products' => []], "No Results Found");
    }


    public function productListByRemark(Request $request): JsonResponse
    {
        $product_list =  $this->productRepository->getByRemark($request->remark);
        return $product_list->isNotEmpty() ?
            $this->successResponse(['products' => ProductResource::collection($product_list)], "Successfully Retrived") :
            $this->successResponse(['products' => []], "No Results Found");
    }


    public function productListByCategory(Request $request): JsonResponse
    {
        $product_list = $this->productService->getProductByCategory($request->category);
        return $product_list->isNotEmpty() ?
            $this->successResponse(['products' => ProductResource::collection($product_list)], "Successfully Retrived") :
            $this->successResponse(['products' => []], "No Results Found");
    }


    public function productListBySubCategory(Request $request): JsonResponse
    {
        $product_list = $this->productService->getProductBySubCategory($request->category, $request->subcategory);
        return $product_list->isNotEmpty() ?
            $this->successResponse(['products' => ProductResource::collection($product_list)], "Successfully Retrived") :
            $this->successResponse(['products' => []], "No Results Found");
    }


    public function searchProducts(Request $request): JsonResponse
    {

        $search_query = $request->keyword;
        $product_list = $this->ProductListModel->search($search_query)->get();
        return $product_list->isNotEmpty() ?
            $this->successResponse(['products' => ProductResource::collection($product_list)], "Successfully Retrived") :
            $this->successResponse(['products' => []], "No Results Found");
    }


    public function relatedProducts(Request $request): JsonResponse
    {
        $product_list = $this->productService->getRelatedProducts($product_id = $request->id,  $relatedProduct = $request->subcategory);
        return $product_list->isNotEmpty() ?
            $this->successResponse(['products' => ProductResource::collection($product_list)], "Successfully Retrived") :
            $this->successResponse(['products' => []], "No Results Found");
    }
}
