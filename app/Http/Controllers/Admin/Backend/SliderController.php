<?php

namespace App\Http\Controllers\Admin\Backend;

use App\Http\Controllers\Controller;
use App\Models\HomeSlider;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $slides = HomeSlider::all();
        return view('admin.slider.slide_view', compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.slide_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return public_path('storage/slider_image/') . 'hello.jpg';
        $validated = $request->validate([
            'slider_image' => 'required|mimes:png,jpg,jpeg'
        ]);

        $file = $request->file('slider_image');
        if ($file) {
            $image_name = 'slider' . date('YmdHi') . $file->getClientOriginalName();

            Image::make($file)->resize(1000, 430)->save(public_path('storage/slider_image/') . $image_name);
        }
        $img_url = "http://localhost:8000/storage/slider_image/" . $image_name;
        $addSlide = HomeSlider::create(['slider_image' => $img_url]);

        $notification = [
            'alert' => $addSlide ? 'success' : 'failed',
            'message' => $addSlide ?  'Slide Succesfully Added' : 'Failed To Add Slide',
        ];

        return  redirect(route("slider.index"))->with('notification', $notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = HomeSlider::find($id)->delete();
        $notification = [
            'alert' => $deleted ? 'success' : 'failed',
            'message' => $deleted ?  'Slide Succesfully Deleted' : 'Failed To Delete Slide',
        ];

        return  redirect(route("slider.index"))->with('notification', $notification);
    }
}
