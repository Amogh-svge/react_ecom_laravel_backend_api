@extends('admin.layout.admin_layout')

@section('main_content')
    <div>
        <div class="az-dashboard-one-title">
            <div>
                <h2 class="az-dashboard-title">Hi, welcome {{ Auth::user()->name }}</h2>
                <p class="az-dashboard-text">Your Site Information Segement.</p>
            </div>
        </div><!-- az-dashboard-one-title -->
        <x-app-layout>
            <form action="{{ route('slider.store') }}" enctype="multipart/form-data" name="slideForm" method="POST"
                class="site_form p-2">
                @csrf
                <x-slot name="header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            Manage Slide
                        </h2>
                        <button class="btn btn-purple" onclick="document.slideForm.submit();">Add</button>
                    </div>
                </x-slot>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="my-3 form_div">
                            <h4 class="font-semibold text-lg text-gray-800 leading-tight">Add New Slide
                            </h4>
                            <p class="az-dashboard-text p-1 mb-3">Choose and Add the picture you want to display in the
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

                            {{-- <img src={{ url('img/no-image.png') }} id="showImage" class="slideImageView  my-3"
                                alt="slide"> --}}
                        </div>
                    </div>
                </div>
            </form>
        </x-app-layout>
    </div>
@endsection
