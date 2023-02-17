@extends('admin.layout.admin_layout')

@section('main_content')
    <div>
        {{-- <h2 class="az-content-title"></h2> --}}
        <div class="az-dashboard-one-title">
            <div class="az-content-breadcrumb text-dark m-2">
                <span>Dashboard</span>
                <span>Slide</span>
                <span>Edit Slide</span>
            </div>
        </div>
        <x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Edit Slide
                </h2>
            </x-slot>

            <form action="{{ route('slider.update', $slider->id) }}" enctype="multipart/form-data" name="slideForm"
                method="POST" class="site_form p-2">
                @csrf @method('PUT')
                <x-slot name="header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            Manage Slide
                        </h2>
                        <button class="btn btn-purple" onclick="document.slideForm.submit();">Update</button>
                    </div>
                </x-slot>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="my-3 form_div">
                            <h4 class="font-semibold text-lg text-gray-800 leading-tight">Update Existing Slide
                            </h4>
                            <p class="az-dashboard-text p-1 mb-3">Choose and Update the picture you want to update in the
                                slide.</p>

                            <div class="slider_file">
                                <p class="p-2">*Only Images Supported</p>
                                <div class="custom-file m-1" id="sliderFileInput">
                                    <input name="slider_image" type="file" class="custom-file-input" id="slider"
                                        accept="image/*" required>
                                    <label class="custom-file-label" for="slider">Choose file</label>
                                </div>
                            </div>
                            @include('admin.common.error', ['field' => 'slider_image'])

                            <p class="text-lg p-1 m-3">Current Image Selected: </p>
                            <img src="{{ $slider->slider_image }}" id="showImage" class="slideImageView  my-3"
                                alt="slide">
                        </div>
                    </div>
                </div>
            </form>

        </x-app-layout>
    </div>
@endsection
