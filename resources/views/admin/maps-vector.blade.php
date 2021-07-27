@extends('layouts.master')

@section('title') @lang('translation.Vector_Map') @endsection

@section('css')
    <!-- Dropzone css -->
    <link href="{{ URL::asset('/assets/libs/jquery-vectormap/jquery-vectormap.min.css') }}" rel="stylesheet"
        type="text/css" />
@endsection

@section('content')

    <!-- start page title -->
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4 class="font-size-18">Vector Map</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Veltrix</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Maps</a></li>
                    <li class="breadcrumb-item active">Vector Map</li>
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
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">World Map</h4>
                    <p class="card-title-desc">Example of vector map.</p>

                    <div id="world-map-markers" style="height: 420px"></div>

                </div>
            </div>
        </div> <!-- end col -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">USA Map</h4>
                    <p class="card-title-desc">Example of vector map.</p>

                    <div id="usa-vectormap" style="height: 420px"></div>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">UK Map</h4>
                    <p class="card-title-desc">Example of vector map.</p>

                    <div id="uk-vectormap" style="height: 420px"></div>

                </div>
            </div>
        </div> <!-- end col -->

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Chicago Map</h4>
                    <p class="card-title-desc">Example of vector map.</p>

                    <div id="chicago-vectormap" style="height: 420px"></div>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection

@section('script')
    <!-- Plugins js -->
    <script src="{{ URL::asset('/assets/libs/jquery-vectormap/jquery-vectormap.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/pages/vector-maps.init.js') }}"></script>
@endsection
