@extends('layouts.master')

@section('title') @lang('translation.Lightbox') @endsection

@section('css')
    <!-- datatables css -->
    <link href="{{ URL::asset('assets/libs/magnific-popup/magnific-popup.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- start page title -->
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4 class="font-size-18">Lightbox</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Veltrix</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">UI Elements</a></li>
                    <li class="breadcrumb-item active">Lightbox</li>
                </ol>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="float-right d-none d-md-block">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle waves-effect waves-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Single image lightbox</h4>
                    <p class="card-title-desc">Three simple popups with different scaling settings.</p>

                    <div class="row">
                        <div class="col-6">
                            <h5 class="mt-0 font-size-14 m-b-15">Fits (Horz/Vert)</h5>
                            <a class="image-popup-vertical-fit" href="{{ URL::asset('/assets/images/small/img-2.jpg') }}" title="Caption. Can be aligned it to any side and contain any HTML.">
                                <img class="img-fluid" alt="" src="{{ URL::asset('/assets/images/small/img-2.jpg') }}"  width="145">
                            </a>
                        </div>
                        <div class="col-6">
                            <h5 class="mt-0 font-size-14 m-b-15">Effects</h5>
                            <a class="image-popup-no-margins" href="{{ URL::asset('/assets/images/small/img-3.jpg') }}">
                                <img class="img-fluid" alt="" src="{{ URL::asset('/assets/images/small/img-3.jpg') }}" width="75">
                            </a>
                            <p class="mt-2 mb-0 text-muted">No gaps, zoom animation, close icon in top-right corner.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Lightbox gallery</h4>
                    <p class="card-title-desc">In this example lazy-loading of images is enabled for the next image based on move direction. </p>

                    <div class="popup-gallery">
                        <a class="float-left" href="{{ URL::asset('/assets/images/small/img-1.jpg') }}" title="Project 1">
                            <div class="img-responsive">
                                <img src="{{ URL::asset('/assets/images/small/img-1.jpg') }}" alt="" width="120">
                            </div>
                        </a>
                        <a class="float-left" href="{{ URL::asset('/assets/images/small/img-2.jpg') }}" title="Project 2">
                            <div class="img-responsive">
                                <img src="{{ URL::asset('/assets/images/small/img-2.jpg') }}" alt="" width="120">
                            </div>
                        </a>
                        <a class="float-left" href="{{ URL::asset('/assets/images/small/img-3.jpg') }}" title="Project 3">
                            <div class="img-responsive">
                                <img src="{{ URL::asset('/assets/images/small/img-3.jpg') }}" alt="" width="120">
                            </div>
                        </a>
                        <a class="float-left" href="{{ URL::asset('/assets/images/small/img-4.jpg') }}" title="Project 4">
                            <div class="img-responsive">
                                <img src="{{ URL::asset('/assets/images/small/img-4.jpg') }}" alt="" width="120">
                            </div>
                        </a>
                        <a class="float-left" href="{{ URL::asset('/assets/images/small/img-5.jpg') }}" title="Project 5">
                            <div class="img-responsive">
                                <img src="{{ URL::asset('/assets/images/small/img-5.jpg') }}" alt="" width="120">
                            </div>
                        </a>
                        <a class="float-left" href="{{ URL::asset('/assets/images/small/img-6.jpg') }}" title="Project 6">
                            <div class="img-responsive">
                                <img src="{{ URL::asset('/assets/images/small/img-6.jpg') }}" alt="" width="120">
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Zoom Gallery</h4>
                    <p class="card-title-desc">Zoom effect works only with images.</p>

                    <div class="zoom-gallery">
                        <a class="float-left" href="{{ URL::asset('/assets/images/small/img-3.jpg') }}" title="Project 1"><img src="{{ URL::asset('/assets/images/small/img-3.jpg') }}" alt="" width="275"></a>
                        <a class="float-left" href="{{ URL::asset('/assets/images/small/img-7.jpg') }}" title="Project 2"><img src="{{ URL::asset('/assets/images/small/img-7.jpg') }}" alt="" width="275"></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Popup with video or map</h4>
                    <p class="card-title-desc">In this example lazy-loading of images is enabled for the next image based on move direction. </p>

                    <div class="row">
                        <div class="col-12">
                            <a class="popup-youtube btn btn-secondary mo-mb-2" href="http://www.youtube.com/watch?v=0O2aH4XLbto">Open YouTube Video</a>
                            <a class="popup-vimeo btn btn-secondary mo-mb-2" href="https://vimeo.com/45830194">Open Vimeo Video</a>
                            <a class="popup-gmaps btn btn-secondary mo-mb-2" href="https://maps.google.com/maps?q=221B+Baker+Street,+London,+United+Kingdom&amp;hl=en&amp;t=v&amp;hnear=221B+Baker+St,+London+NW1+6XE,+United+Kingdom">Open Google Map</a>
                        </div>
                    </div>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection

@section('script')
    <!-- Plugins js -->
    <script src="{{ URL::asset('/assets/libs/magnific-popup/magnific-popup.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/pages/lightbox.init.js') }}"></script>
@endsection
