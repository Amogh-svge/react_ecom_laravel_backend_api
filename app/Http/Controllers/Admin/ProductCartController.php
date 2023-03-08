<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddToCartRequest;
use App\Models\CartOrder;
use App\Models\ProductCart;
use App\Models\ProductList;
use Exception;
use Illuminate\Http\Request;

class ProductCartController extends Controller
{
    public function addToCart(AddToCartRequest $request)
    {
        try {
            $email = $request->email;
            $size = $request->size;
            $color = $request->color;
            $quantity = $request->quantity;
            $product_code = $request->product_code;

            $Product_details = ProductList::where('product_code', $product_code)->first();
            $price = $Product_details->price;
            $special_price = $Product_details->special_price;

            if ($special_price != null) {
                $total_price =  $special_price * $quantity;
                $unit_price =  $special_price;
            } else {
                $total_price =  $price * $quantity;
                $unit_price =  $price;
            }

            $result = ProductCart::create([
                'email' => $email,
                'image' => $Product_details->image,
                'product_name' => $Product_details->title,
                'product_code' => $Product_details->product_code,
                'size' => 'Size: ' . $size,
                'color' => 'Color: ' . $color,
                'quantity' => $quantity,
                'unit_price' => $unit_price,
                'total_price' => $total_price,
            ]);

            return $result;
        } catch (Exception $exception) {
            return response([
                'message' => $exception->getMessage()
            ], 400);
        }
    } //End Method

    public function cartCount(Request $request)
    {
        $email = $request->email;
        $result = ProductCart::where('email', $email)->count();
        return $result;
    } //End Method

    public function cartList(Request $request)
    {
        $email = $request->email;
        return $cart_list = ProductCart::where('email', $email)->get();
    }

    public function removeCartList(Request $request)
    {
        $id = $request->id;
        $result = ProductCart::where('id', $id)->delete();
        return $result ? response("Item Successfully Removed", 200) : response("Failed To Remove Item", 400);
    }

    public function cartItemPlus(Request $request)
    {
        $id = $request->id;
        $quantity = $request->quantity;
        $price = $request->price;
        $newQuantity = $quantity + 1;
        $total_price = $newQuantity * $price;
        $result  = ProductCart::where('id', $id)->update([
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
        $result  = ProductCart::where('id', $id)->update([
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

    public function cartOrder(Request $request)
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

        $cart_list = ProductCart::where('email', $email)->get();

        foreach ($cart_list as $cart_item) {
            $cartInsertDeleteResult = "";

            $result = CartOrder::insert([
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
                $resultDelete = ProductCart::where('id', $cart_item['id'])->delete();
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
        $result = CartOrder::where('email', $email)->orderBy('id', 'DESC')->get();
        return $result;
    }
}
