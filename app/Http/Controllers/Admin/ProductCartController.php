<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddToCartRequest;
use App\Models\{CartOrder, ProductCart, ProductList};
use App\Services\CartService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductCartController extends Controller
{
    protected ProductList $productListModel;
    protected ProductCart $productCartModel;
    protected CartOrder $cartOrderModel;
    protected CartService $service;

    public function __construct(ProductList $productListModel,  ProductCart $productCartModel, CartOrder $cartOrderModel, CartService $service)
    {
        $this->productListModel = $productListModel;
        $this->productCartModel = $productCartModel;
        $this->cartOrderModel = $cartOrderModel;
        $this->service = $service;
    }

    public function add(AddToCartRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $data = $this->service->addToCart($validated);

        return $data ?
            $this->successResponse(['data' => $data], "Successfully Created") :
            $this->errorResponse(['data' => []], "Failed To Create");
    }

    public function count(Request $request)
    {
        $email = $request->email;
        $result = $this->productCartModel->email($email)->count();
        return $result;
    } //End Method

    public function index(Request $request)
    {
        $email = $request->email;
        return $cart_list = $this->productCartModel->email($email)->get();
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $result = $this->productCartModel->getById($id)->delete();
        return $result ? response("Item Successfully Removed", 200) : response("Failed To Remove Item", 400);
    }

    public function cartItemPlus(Request $request)
    {
        $id = $request->id;
        $quantity = $request->quantity;
        $price = $request->price;
        $newQuantity = $quantity + 1;
        $total_price = $newQuantity * $price;
        $result  = $this->productCartModel->getById($id)->update([
            'quantity' => $newQuantity,
            'total_price' => $total_price,
        ]);

        return $result ? response("Cart Successfully Updated", 200) : response("Failed To Update Cart", 400);
    }

    public function cartItemMinus(Request $request)
    {
        $id = $request->id;
        $quantity = $request->quantity;
        $price = $request->price;
        ($quantity > 0) ? $newQuantity = $quantity - 1 : $newQuantity = 0;
        $total_price = $newQuantity * $price;
        $result  = $this->productCartModel->getById($id)->update([
            'quantity' => $newQuantity,
            'total_price' => $total_price,
        ]);

        if ($result && $quantity > 0) {
            return response([
                "message" => "Cart Successfully Updated",
                "quantity" => $quantity,
                "status" => 200
            ]);
        } else {
            return response("Failed To Update Cart", 400);
        }
    }

    public function order(Request $request)
    {
        $city = $request->city;
        $payment = $request->payment_method;
        $name = $request->name;
        $email = $request->email;
        $delivery_address = $request->delivery_address;
        $invoice_no = $request->invoice_no;
        $delivery_charge = $request->delivery_charge;

        date_default_timezone_set("Asia/Dhaka");
        $request_time = date("h:i:sa");
        $request_date = date("d-m-y");

        $cart_list = $this->productCartModel->email($email)->get();

        foreach ($cart_list as $cart_item) {
            $cartInsertDeleteResult = "";

            $result =  $this->cartOrderModel->insert([
                'invoice_no' => "Easy" . $invoice_no,
                'product_name' => $cart_item['product_name'],
                'product_code' => $cart_item['product_code'],
                'size' => $cart_item['size'],
                'color' => $cart_item['color'],
                'quantity' => $cart_item['quantity'],
                'unit_price' => $cart_item['unit_price'],
                'total_price' => $cart_item['total_price'],
                'email' => $cart_item['email'],
                'name' => $name,
                'payment_method' => $payment,
                'delivery_address' => $delivery_address,
                'city' => $city,
                'delivery_charge' => $delivery_charge,
                'order_date' => $request_date,
                'order_time' => $request_time,
                'order_status' => "Pending",
            ]);

            if ($result == 1) {
                $resultDelete = $this->productCartModel->getById($cart_item['id'])->delete();
                if ($resultDelete == 1) {
                    $cartInsertDeleteResult = 1;
                } else {
                    $cartInsertDeleteResult = 0;
                }
            }
        }

        return $cartInsertDeleteResult;
    }

    public function orderListByUser(Request $request)
    {
        $email = $request->email;
        $result =  $this->cartOrderModel->email($email)->orderBy('id', 'DESC')->get();
        return $result;
    }
}
