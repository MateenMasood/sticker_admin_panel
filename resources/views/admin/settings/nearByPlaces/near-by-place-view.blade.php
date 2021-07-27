@extends('admin.layouts.master')

@section('title') @lang('translation.Gallery') @endsection

@section('css')
    <!-- Lightbox css -->
    <link href="{{ URL::asset('/assets/libs/magnific-popup/magnific-popup.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    <!-- start page title -->
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4 class="font-size-18">Gallery</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">S Chalet</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">settings</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Near by places List</a></li>
                    <li class="breadcrumb-item active">Near by places View</li>
                </ol>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="float-right d-none d-md-block">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle waves-effect waves-light" type="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="mdi mdi-settings mr-2"></i> Settings
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Separated link</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->


    <div class="row">
        @foreach ($singleNearByPlaceRecord->nearByPlaceFile as $item)
        <div class="col-xl-3 col-md-6">
            <a href="{{ URL::asset('/storage/'.$item->path) }}" class="gallery-popup" title="Hotel Near by places">
                <div class="project-item">
                    <div class="overlay-container">
                        <img src="{{ URL::asset('/storage/'.$item->path) }}" alt="img" class="gallery-thumb-img">
                        <div class="project-item-overlay">
                            <h4>{{ $singleNearByPlaceRecord->title }}</h4>
                            <p>
                                {{-- <img src="{{ URL::asset('/assets/images/users/user-1.jpg') }}" alt="user" class="avatar-sm rounded-circle" />
                                <span class="ml-2">Curtis Marion</span> --}}
                            </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>

@endsection

@section('script')
    <!-- Plugins js -->
    <script src="{{ URL::asset('assets/libs/magnific-popup/magnific-popup.min.js') }}"></script>

    <script src="{{ URL::asset('assets/js/pages/gallery.init.js') }}"></script>

@endsection
