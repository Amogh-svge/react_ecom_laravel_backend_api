<?php

namespace App\Repository;

use App\Models\ProductDetails;
use App\Models\ProductList;
use App\Models\ProductReview;
use App\Repository\BaseRepository;

class ProductRepository extends BaseRepository
{
    protected ProductDetails $productDetailsModel;
    protected ProductReview $productReviewModel;

    public function __construct(ProductList $model, ProductDetails $productDetailsModel, ProductReview $productReviewModel)
    {
        parent::__construct($model);
        $this->productDetailsModel = $productDetailsModel;
        $this->productReviewModel = $productReviewModel;
    }

    public function getByRemark(string $remark, bool $first = false): object
    {
        $query = $this->where('remark', $remark)->with('productDetail');
        return ($first) ? $query->firstOrFail() : $query->get();
    }

    public function getById(int $id, bool $first = false): object
    {
        $query =  $this->where('id', $id)->with('productDetail');
        return ($first) ? $query->firstOrFail() : $query->get();
    }

    public function getReviews(string $product_code, int $limit, string $direction): object
    {
        parent::__construct($this->productReviewModel);
        return $this->where('product_code', $product_code)
            ->orderBy('id', $direction)->limit($limit)->get();
    }
}
