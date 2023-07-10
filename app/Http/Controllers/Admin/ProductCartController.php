<?php

namespace App\Http\Controllers\Admin;

use App\Http\{
    Controllers\Controller,
    Requests\AddToCartRequest
};
use App\Http\Requests\CartItemRequest;
use App\Models\{CartOrder, ProductCart, ProductList};
use App\Repository\ProductRepository;
use App\Services\CartService;
use Illuminate\Http\{JsonResponse};


class ProductCartController extends Controller
{
    protected ProductList $productListModel;
    protected ProductCart $productCartModel;
    protected CartOrder $cartOrderModel;
    protected CartService $service;
    protected ProductRepository $productRepository;

    public function __construct(
        ProductList $productListModel,
        ProductCart $productCartModel,
        CartOrder $cartOrderModel,
        CartService $service,
        ProductRepository $productRepository
    ) {
        $this->productListModel = $productListModel;
        $this->productCartModel = $productCartModel;
        $this->cartOrderModel = $cartOrderModel;
        $this->productRepository = $productRepository;
        $this->service = $service;
    }

    /**
     * list all the cart products on basis of email
     */
    public function index(string $email): JsonResponse
    {
        $data = $this->productCartModel->email($email)->orderBy('id', 'DESC')->paginate(10);

        return $data ?
            $this->successResponse(['data' => $data], "Successfully Retrieved") :
            $this->errorResponse(['data' => []], "Failed To Create");
    }

    /**
     * add products to cart
     */
    public function add(AddToCartRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $data = $this->service->addToCart($validated);

        return $data ?
            $this->successResponse(['data' => $data], "Successfully Created") :
            $this->errorResponse(['data' => []], "Failed To Create");
    }

    /**
     * total number of products in cart
     */
    public function count(string $email): JsonResponse
    {
        $data = $this->productCartModel->email($email)->count();
        return $data ?
            $this->successResponse(['data' => $data], "Successfully Retrieved") :
            $this->errorResponse(['data' => []], "Failed To Retrieved");
    }

    /**
     * delete products in cart
     */
    public function delete(ProductCart $cart): JsonResponse
    {
        $data = $cart->delete();

        return $data ?
            $this->successResponse(['data' => []], "Successfully Deleted") :
            $this->errorResponse(['data' => []], "Failed To Delete");
    }

    /**
     * increase product's quantity in cart
     */
    public function cartItemPlus(CartItemRequest $request, ProductCart $cart): JsonResponse
    {
        $validated = $request->validated();
        $result = $this->service->addItem($validated, $cart);

        return $result ?
            $this->successResponse(['data' => []], "Successfully Updated") :
            $this->errorResponse(['data' => []], "Failed To Update");
    }

    /**
     * decrease product's quantity in cart
     */
    public function cartItemMinus(CartItemRequest $request, ProductCart $cart): JsonResponse
    {
        $validated = $request->validated();
        $result = $this->service->removeItem($validated, $cart);

        return $result ?
            $this->successResponse(['data' => []], "Successfully Updated") :
            $this->errorResponse(['data' => []], "Failed To Update");
    }
}
