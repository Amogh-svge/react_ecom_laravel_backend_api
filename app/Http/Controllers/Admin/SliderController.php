<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSlider;
use Illuminate\Http\JsonResponse;

class SliderController extends Controller
{
    public function index(): JsonResponse
    {
        $result = HomeSlider::paginate();

        return $this->successResponse([$result], 'Successfully Retrieved');
    }
}
