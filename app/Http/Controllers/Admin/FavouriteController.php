<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FavouriteRequest;
use App\Http\Resources\{FavouriteResource, ProductResource};
use App\Models\{Favourite, ProductList};
use Illuminate\Http\{JsonResponse, Request};
use Illuminate\Support\Arr;

class FavouriteController extends Controller
{
    protected ProductList $productList;
    protected Favourite $favouriteModel;

    public function __construct(ProductList $productList, Favourite $favouriteModel)
    {
        $this->productList = $productList;
        $this->favouriteModel = $favouriteModel;
    }

    public function create(FavouriteRequest $request): JsonResponse
    {
        $created = $this->favouriteModel->create($request->validated());
        $favourite = $created->with('products')->find($created->id);
        return $created ?
            $this->successResponse(['data' => new FavouriteResource($favourite)], "Successfully Retrieved") :
            $this->successResponse(['data' => []], "No Results Found");
    }

    public function index(Request $request): JsonResponse
    {
        $favourites = $this->favouriteModel->email($request->email)->with('products')->get();
        $products = $favourites->pluck('products');
        $products = Arr::collapse($products);

        return $products ?
            $this->successResponse(['data' => ProductResource::collection($products)], "Successfully Retrieved") :
            $this->successResponse(['data' => []], "No Results Found");
    }

    public function destroy(Favourite $favourite): JsonResponse
    {
        $deleted = $favourite->delete();
        return $deleted ?
            $this->successResponse(['data' => []], "Successfully Deleted") :
            $this->errorResponse(['data' => []], "Failed To Delete");
    }
}
