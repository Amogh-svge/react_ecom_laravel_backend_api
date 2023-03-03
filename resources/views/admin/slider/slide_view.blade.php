@extends('admin.layout.admin_layout')
@section('main_content')
    <div>
        <h2 class="az-content-title">Sub_Category List</h2>
        <div class="az-content-breadcrumb">
            <span>Dashboard</span>
            <span>Sub_Category</span>
            <span>List Sub_Category</span>
        </div>


        <div class="card-body">
            @foreach ($slides as $key => $slide)
                <div id="accordion">
                    <div class="card">
                        <div class="card-header d-flex  justify-content-between" id="headingOne">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{ $key }}"
                                aria-expanded="true" aria-controls="collapse{{ $key }}">
                                <h5 class="mb-0 text-white btn btn-purple d-flex">
                                    Slide Image {{ $key + 1 }}
                                    {{-- <ion-icon name="arrow-dropdown-circle"></ion-icon> --}}
                                    <ion-icon name="ios-arrow-down" class="ml-2 icon-size"></ion-icon>
                                </h5>
                            </button>
                            <div class="w-50 d-flex justify-content-end align-items-center">
                                <a href="{{ route('slider.edit', $slide->id) }}" type="submit" class="btn btn-dark mx-2">
                                    <i class="fas fa-edit fa-lg "></i>
                                </a>
                                <form method="POST" action="{{ route('slider.destroy', $slide->id) }}">
                                    @method('DELETE')
                                    @csrf
                                    <button
                                        onclick="event.preventDefault(); window.confirm('Do you want to delete?')===true &&
                                        this.closest('form').submit();"
                                        type="submit" class="btn btn-dark">
                                        <i class="fas fa-trash fa-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div id="collapse{{ $key }}" class="collapse " aria-labelledby="headingOne"
                            data-parent="#accordion">
                            <div class="card-body">
                                <img src="{{ $slide->slider_image }}" class="w-100" alt="slide">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="d-flex justify-content-center mt-5">
                {!! $slides->links() !!}
            </div>
        </div>
    </div>
@endsection
