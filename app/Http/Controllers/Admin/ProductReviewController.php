<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use App\Models\ProductReview;
use App\Repository\ProductRepository;
use Illuminate\Http\JsonResponse;

class ProductReviewController extends Controller
{
    protected ProductReview $productReviewModel;

    protected ProductRepository $productRepository;

    public function __construct(ProductReview $productReviewModel, ProductRepository $productRepository)
    {
        $this->productReviewModel = $productReviewModel;
        $this->productRepository = $productRepository;
    }

    public function index(string $code): JsonResponse
    {
        $review_list = $this->productRepository->getReviews($code, 4, 'desc');

        return $review_list->isNotEmpty() ?
            $this->successResponse(['data' => $review_list], 'Successfully Retrived') :
            $this->successResponse(['data' => []], 'No Results Found');
    }

    public function create(ReviewRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $review = $this->productReviewModel->create($validated);

        return $review ?
            $this->successResponse(['data' => $review], 'Successfully Created') :
            $this->errorResponse(['data' => []], 'Failed To Create');
    }
}
