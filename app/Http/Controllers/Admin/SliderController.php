<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSlider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function allSlider()
    {
        return $result = HomeSlider::all();
    }
}
