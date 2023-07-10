<?php

namespace App\Services;

use App\Models\CartOrder;
use App\Models\ProductCart;
use App\Models\ProductList;
use App\Repository\ProductRepository;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class CartService
{
    protected ProductList $productListModel;
    protected ProductCart $productCartModel;
    protected CartOrder $cartOrderModel;
    protected ProductRepository $productRepository;

    public function __construct(ProductList $productListModel,  ProductCart $productCartModel, CartOrder $cartOrderModel, ProductRepository $productRepository)
    {
        $this->productListModel = $productListModel;
        $this->productCartModel = $productCartModel;
        $this->cartOrderModel = $cartOrderModel;
        $this->productRepository = $productRepository;
    }

    public function addToCart(array $data): object
    {
        $product = $this->productRepository->getByProductCode($data['product_code'], true);
        dd($product);

        $price = $product->price;
        $special_price = $product->special_price;

        if ($special_price != null) {
            $total_price =  $special_price * $data['quantity'];
            $unit_price =  $special_price;
        } else {
            $total_price =  $price * $data['quantity'];
            $unit_price =  $price;
        }

        $data += [
            'image' => $product->image,
            'product_name' => $product->title,
            'product_code' => $product->product_code,
            'unit_price' => $unit_price,
            'total_price' => $total_price,
        ];

        return $data = $this->productCartModel->create($data);
    }
}
