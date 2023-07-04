<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSlider;
use Illuminate\Http\JsonResponse;

class SliderController extends Controller
{
    public function allSlider(): JsonResponse
    {
        $result = HomeSlider::all();
        return $this->successResponse([$result], "Successfully Retrieved");
    }
}
