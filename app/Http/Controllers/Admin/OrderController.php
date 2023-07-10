<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CartOrder;
use App\Models\ProductCart;
use App\Repository\ProductRepository;
use App\Services\CartService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected ProductCart $productCartModel;
    protected CartOrder $cartOrderModel;
    protected CartService $service;
    protected ProductRepository $productRepository;

    public function __construct(
        ProductCart $productCartModel,
        CartOrder $cartOrderModel,
        CartService $service,
        ProductRepository $productRepository
    ) {
        $this->productCartModel = $productCartModel;
        $this->cartOrderModel = $cartOrderModel;
        $this->productRepository = $productRepository;
        $this->service = $service;
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
