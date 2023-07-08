<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FavouriteRequest;
use App\Models\Favourite;
use App\Models\ProductList;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    protected ProductList $productList;
    protected Favourite $favouriteModel;

    public function __construct(ProductList $productList, Favourite $favouriteModel)
    {
        $this->productList = $productList;
        $this->favouriteModel = $favouriteModel;
    }

    public function create(FavouriteRequest $request)
    {
        $product_code = $request->product_code;
        $email = $request->email;
        $Product_details = $this->productList->productCode($product_code)->first();

        $result = $this->favouriteModel->create([
            'email' => $email,
            'image' => $Product_details->image,
            'product_name' => $Product_details->title,
            'product_code' => $product_code,
        ]);

        return $result;
    }

    public function index(Request $request): JsonResponse
    {
        $favourite_list = $this->favouriteModel->email($request->email)->with('products')->get();
        return $favourite_list->isNotEmpty() ?
            $this->successResponse(['data' => $favourite_list], "Successfully Retrieved") :
            $this->successResponse(['data' => []], "No Results Found");
    }

    public function destroy(Request $request)
    {
        $email = $request->email;
        $product_code = $request->product_code;

        $remove_product = $this->favouriteModel->productCode($product_code)->where('email', $email)->delete();
        return $remove_product;
    }
}
