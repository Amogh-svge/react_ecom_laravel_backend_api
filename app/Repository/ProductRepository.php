<?php

namespace App\Repository;

use App\Models\ProductDetails;
use App\Models\ProductList;
use App\Repository\BaseRepository;

class ProductRepository extends BaseRepository
{
    protected ProductDetails $productDetailsModel;

    public function __construct(ProductList $model, ProductDetails $productDetailsModel)
    {
        parent::__construct($model);
        $this->productDetailsModel = $productDetailsModel;
    }

    public function getByRemark(string $remark): object
    {
        return $this->where('remark', $remark)->with('productDetail');
    }
}
