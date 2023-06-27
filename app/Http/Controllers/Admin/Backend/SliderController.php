<?php

namespace App\Http\Controllers\Admin\Backend;

use App\Http\Controllers\Controller;
use App\Models\HomeSlider;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    protected HomeSlider $homeSliderModel;

    /**
     * @param HomeSlider $homeSliderModel
     */
    public function __construct(HomeSlider $homeSliderModel)
    {
        $this->homeSliderModel = $homeSliderModel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $slides =  $this->homeSliderModel->latest()->paginate(7);
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
        $validated = $request->validate([
            'slider_image' => 'required|mimes:png,jpg,jpeg'
        ]);

        $file = $request->file('slider_image');
        if ($file) {
            $image_name = 'slider' . date('YmdHi') . $file->getClientOriginalName();
            Image::make($file)->resize(1000, 430)->save(public_path('storage/slider_image/') . $image_name);
        }
        $img_url = "http://localhost:8000/storage/slider_image/" . $image_name;
        $addSlide =  $this->homeSliderModel->create(['slider_image' => $img_url]);

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
    public function edit(HomeSlider $slider)
    {
        return view('admin.slider.slide_edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HomeSlider $slider)
    {
        $validated = $request->validate([
            'slider_image' => 'required|mimes:png,jpg,jpeg'
        ]);

        $file = $request->file('slider_image');
        if ($file) {
            $image_name = 'slider' . date('YmdHi') . $file->getClientOriginalName();
            Image::make($file)->resize(1000, 430)->save(public_path('storage/slider_image/') . $image_name);

            //Seperate image name from the url
            $existing_image_path = explode("http://localhost:8000/storage/slider_image/", $slider->slider_image);
            $stored_image_name = $existing_image_path[1];
            unlink(public_path('storage/slider_image/') . $stored_image_name);
        }
        $img_url = "http://localhost:8000/storage/slider_image/" . $image_name;
        $updateSlide = $slider->update(['slider_image' => $img_url]);

        $notification = [
            'alert' => $updateSlide ? 'success' : 'failed',
            'message' => $updateSlide ?  'Slide Succesfully Updated' : 'Failed To Update Slide',
        ];

        return  redirect(route("slider.index"))->with('notification', $notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(HomeSlider $slider)
    {
        $existing_image_path = explode("http://localhost:8000/storage/slider_image/", $slider->slider_image);
        $stored_image_name = $existing_image_path[1];

        $deleted = $slider->delete();
        if ($deleted) {
            unlink(public_path('storage/slider_image/') . $stored_image_name);
        }
        $notification = [
            'alert' => $deleted ? 'success' : 'failed',
            'message' => $deleted ?  'Slide Succesfully Deleted' : 'Failed To Delete Slide',
        ];

        return  redirect(route("slider.index"))->with('notification', $notification);
    }
}
