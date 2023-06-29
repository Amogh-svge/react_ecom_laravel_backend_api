<?php

namespace App\Http\Controllers\Admin\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductRequest;
use App\Models\Category;
use App\Models\ProductList;
use App\Models\ProductDetails;
use App\Models\Subcategory;
use App\Services\ProductService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

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


    public function index(): View
    {
        $products = $this->ProductListModel->latest()->get();
        return view("admin.product.product_view", compact('products'));
    }


    public function create(): View
    {
        $category = $this->categoryModel->latest()->get();
        $subcategory = $this->subcategoryModel->latest()->get();
        return view("admin.product.product_create", compact(['category', 'subcategory']));
    }


    public function store(AddProductRequest $request): RedirectResponse
    {
        $stored = $this->productService->store($request);

        $notification = $this->notification($stored, 'Product Succesfully Added', 'Failed To Add Product');
        return  redirect(route("product.index"))->with('notification', $notification);
    }


    public function show(ProductList $product): View
    {
        $product_details = ProductDetails::where('product_id', $product->id)->first();
        $product_info = collect($product)->merge($product_details);
        return view('admin.product.product_details', compact('product_info'));
    }


    public function edit(ProductList $product): View
    {
        $category = $this->categoryModel->pluck('category_name');
        $subcategory = $this->subcategoryModel->pluck('subcategory_name');
        $product_info = $this->productService->edit($product);
        return view('admin.product.product_edit', compact(['product_info', 'subcategory', 'category']));
    }


    public function update(AddProductRequest $request, ProductList $product): RedirectResponse
    {
        $updated = $this->productService->update($request, $product);

        $notification = $this->notification($updated, 'Product Succesfully Updated', 'Failed To Update Product');
        return  redirect(route("product.index"))->with('notification', $notification);
    }


    public function destroy(ProductList $product): RedirectResponse
    {
        $deleted = $this->productService->delete($product);

        $notification = $this->notification($deleted, 'Product Succesfully Deleted', 'Failed To Delete Product');
        return  redirect(route("product.index"))->with('notification', $notification);
    }
}
