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
            <form action="{{ route('siteInfo.update') }}" method="POST" name="theForm" class="form-responsive site_form p-2">
                @csrf
                @method('PUT')
                <x-slot name="header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            Manage Site Information
                        </h2>
                        <button class="btn btn-purple" onclick="document.theForm.submit();">Update</button>
                    </div>
                </x-slot>
                <div class="row">
                    <div class="col-lg-12">

                        <div class="my-3 form_div">
                            <h4 class="font-semibold text-lg text-gray-800 leading-tight">About Page Information</h4>
                            <p class="az-dashboard-text p-1 mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Adipisci ratione porro ullam suscipit odio officiis doloremque qui pariatur asperiores
                                blanditiis dolore nostrum, laborum labore dolorem. Fuga error qui voluptate culpa.</p>
                            <span class="input-group-text font-semibold text-md text-gray-700 leading-tight"
                                id="about-span">Manage About Page</span>
                            <textarea name="about" cols="30" rows="10" class="form-control" id="editor1"
                                aria-label="Enter Your About Page Content" placeholder="Enter Your About Page Content"
                                aria-describedby="about-span">{{ $site_info->about }}</textarea>

                            @include('admin.common.error', ['field' => 'about']) {{-- error message --}}
                        </div>

                        <div class="my-3 form_div">
                            <h4 class="font-semibold text-lg text-gray-800 leading-tight">Refund Page Information</h4>
                            <p class="az-dashboard-text p-1 mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Adipisci ratione porro ullam suscipit odio officiis doloremque qui pariatur asperiores
                                blanditiis dolore nostrum, laborum labore dolorem. Fuga error qui voluptate culpa.</p>
                            <span class="input-group-text font-semibold text-md text-gray-700 leading-tight"
                                id="refund-span">Manage Refund
                                Page</span>
                            <textarea name="refund" cols="30" rows="10" class="form-control" id="editor2"
                                aria-label="Enter Your Refund Content" placeholder="Enter Your Refund Page Content" aria-describedby="refund-span">{{ $site_info->refund }}</textarea>

                            @include('admin.common.error', ['field' => 'refund']) {{-- error message --}}
                        </div>

                        <div class="my-3 form_div">
                            <h4 class="font-semibold text-lg text-gray-800 leading-tight">Purchase Guide Information</h4>
                            <p class="az-dashboard-text p-1 mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Adipisci ratione porro ullam suscipit odio officiis doloremque qui pariatur asperiores
                                blanditiis dolore nostrum, laborum labore dolorem. Fuga error qui voluptate culpa.</p>
                            <span class="input-group-text font-semibold text-md text-gray-700 leading-tight"
                                id="purchase_guide-span">Manage
                                Purchase Guide
                                Page</span>
                            <textarea name="purchase_guide" cols="30" rows="10" class="form-control" id="editor3"
                                aria-label="Enter Your Purchase Guide Page Content" placeholder="Enter Your Purchase Guide Page Content"
                                aria-describedby="purchase_guide-span">{{ $site_info->purchase_guide }}</textarea>

                            @include('admin.common.error', ['field' => 'purchase_guide']) {{-- error message --}}
                        </div>

                        <div class="my-3 form_div">
                            <h4 class="font-semibold text-lg text-gray-800 leading-tight">Privacy Information</h4>
                            <p class="az-dashboard-text p-1 mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Adipisci ratione porro ullam suscipit odio officiis doloremque qui pariatur asperiores
                                blanditiis dolore nostrum, laborum labore dolorem. Fuga error qui voluptate culpa.</p>
                            <span class="input-group-text font-semibold text-md text-gray-700 leading-tight"
                                id="privacy-span">Manage Privacy
                                Page</span>
                            <textarea name="privacy" cols="30" rows="10" class="form-control" id="editor4"
                                aria-label="Enter Your Privacy Page Content" placeholder="Enter Your Privacy Page Content"
                                aria-describedby="privacy-span">{{ $site_info->privacy }}</textarea>

                            @include('admin.common.error', ['field' => 'privacy']) {{-- error message --}}
                        </div>

                        <div class="my-3 p-1 form_div">
                            <h4 class="font-semibold text-lg text-gray-800 leading-tight">Address Page Information</h4>
                            <p class="az-dashboard-text p-1 mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Adipisci ratione porro ullam suscipit odio officiis doloremque qui pariatur asperiores
                                blanditiis dolore nostrum, laborum labore dolorem. Fuga error qui voluptate culpa.</p>
                            <span class="input-group-text font-semibold text-md text-gray-700 leading-tight"
                                id="address-span">Manage Address
                                Page</span>
                            <textarea name="address" cols="30" rows="10" class="form-control" id="editor0"
                                aria-label="Enter Your Address Page Content" placeholder="Enter Your Address Page Content"
                                aria-describedby="address-span">{{ $site_info->address }}</textarea>

                            @include('admin.common.error', ['field' => 'address']) {{-- error message --}}
                        </div>

                        <h4 class="font-semibold text-center text-lg text-gray-800 leading-tight">Manage Links</h4>

                        <div class="row my-3 p-1 form_div">
                            <span class="col">
                                <span class="input-group-text font-semibold text-md text-gray-700 leading-tight"
                                    id="address-span">Facebook Link</span>
                                <input type="url" name="facebook_link" class="form-control"
                                    aria-label="Enter Your Address Page Content" placeholder="https://example.com"
                                    pattern="https://.*" aria-describedby="address-span"
                                    value="{{ $site_info->facebook_link }}">

                                @include('admin.common.error', ['field' => 'facebook_link']) {{-- error message --}}
                            </span>

                            <span class="col">
                                <span class="input-group-text font-semibold text-md text-gray-700 leading-tight"
                                    id="address-span">Instagram Link</span>
                                <input type="url" name="instagram_link" class="form-control"
                                    aria-label="Enter Your Address Page Content" placeholder="https://example.com"
                                    pattern="https://.*" aria-describedby="address-span"
                                    value="{{ $site_info->instagram_link }}">

                                @include('admin.common.error', ['field' => 'instagram_link']) {{-- error message --}}
                            </span>

                            <span class="col">
                                <span class="input-group-text font-semibold text-md text-gray-700 leading-tight"
                                    id="address-span">Twitter Link</span>
                                <input type="url" name="twitter_link" class="form-control"
                                    aria-label="Enter Your Address Page Content" placeholder="https://example.com"
                                    pattern="https://.*" aria-describedby="address-span"
                                    value="{{ $site_info->twitter_link }}">

                                @include('admin.common.error', ['field' => 'twitter_link']) {{-- error message --}}
                            </span>
                        </div>

                        <div class="row my-3 p-1 form_div">
                            <span class="col">
                                <span class="input-group-text font-semibold text-md text-gray-700 leading-tight"
                                    id="address-span">IOS App Link</span>
                                <input type="url" name="ios_app_link" class="form-control"
                                    aria-label="Enter Your Address Page Content" placeholder="https://example.com"
                                    pattern="https://.*" aria-describedby="address-span"
                                    value="{{ $site_info->ios_app_link }}">

                                @include('admin.common.error', ['field' => 'ios_app_link']) {{-- error message --}}
                            </span>

                            <span class="col">
                                <span class="input-group-text font-semibold text-md text-gray-700 leading-tight"
                                    id="address-span">Android App Link</span>
                                <input type="url" name="android_app_link" class="form-control"
                                    aria-label="Enter Your Address Page Content" placeholder="https://example.com"
                                    pattern="https://.*" aria-describedby="address-span"
                                    value="{{ $site_info->android_app_link }}">

                                @include('admin.common.error', ['field' => 'android_app_link']) {{-- error message --}}
                            </span>

                            <span class="col">
                                <span class="input-group-text font-semibold text-md text-gray-700 leading-tight"
                                    id="address-span">Copyright Link</span>
                                <input type="url" name="copyright_link" class="form-control"
                                    aria-label="Enter Your Address Page Content" placeholder="https://example.com"
                                    pattern="https://.*" aria-describedby="address-span"
                                    value="{{ $site_info->copyright_link }}">

                                @include('admin.common.error', ['field' => 'copyright_link']) {{-- error message --}}
                            </span>
                        </div>



                    </div>
                </div>
            </form>
        </x-app-layout>
    </div>
@endsection
