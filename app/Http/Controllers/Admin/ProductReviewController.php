<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    protected ProductReview $productReviewModel;

    public function __construct(ProductReview $productReviewModel)
    {
        $this->productReviewModel = $productReviewModel;
    }

    public function reviewList(Request $request)
    {
        $product_code = $request->code;
        $review_list = $this->productReviewModel->where('product_code', $product_code)
            ->orderBy('id', 'desc')->limit(4)->get();
        return $review_list;
    }

    public function postReview(Request $request)
    {
        $product_code = $request->product_code;
        $product_name = $request->product_name;
        $reviewer_name = $request->reviewer_name;
        $reviewer_photo = $request->photo;
        $reviewer_rating = $request->reviewer_rating;
        $reviewer_comment = $request->reviewer_comment;

        $review_list = $this->productReviewModel->insert([
            'product_code' =>  $product_code,
            'product_name' =>  $product_name,
            'reviewer_name' =>  $reviewer_name,
            'reviewer_photo' =>  $reviewer_photo,
            'reviewer_rating' =>  $reviewer_rating,
            'reviewer_comment' =>  $reviewer_comment,
        ]);

        return $review_list;
    }
}
