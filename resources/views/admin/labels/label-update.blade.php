@extends('admin.layouts.master')

@section('title') @lang('translation.Form_Validation') @endsection


@section('css')

    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    <!-- start page title -->
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4 class="font-size-18">Add Slider</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">S Chalet</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">sliders List</a></li>
                    <li class="breadcrumb-item active">Slider Add</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <form class="formCreate" id="formCreateLabel">
                        @csrf

                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="col-md-12 col-lg-12">

                                    <div class="form-group">
                                        <label>Premium</label>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="yes"
                                                name="status">
                                            <label class="custom-control-label" for="yes">yes</label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="col-md-12 col-lg-12">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="no"
                                            name="status">
                                        <label class="custom-control-label" for="no">no</label>
                                    </div>

                                </div>
                            </div>
                        </div>

                        {{-- ******************* pics upload ************************** --}}

                        <div class="row mb-5">
                            <div class="col-md-12 col-lg-12">
                                <label> Labels images  </label>

                                <div class="dropzone">
                                    <div class="fallback">
                                        <input name="file[]" type="file" multiple="multiple" required>
                                    </div>
                                </div>

                            </div>
                        </div>



                        <div class="form-group mb-0">
                            <div>
                                <button type="submit" id="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                    Submit
                                </button>
                                <button type="reset" class="btn btn-secondary waves-effect">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection

@section('script')


    <script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}"></script>



    <script src="{{ URL::asset('/assets/js/jquery.validate/jquery.validate.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/dropzone/dropzone.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/notify.js') }}"></script>

    <script src="{{ URL::asset('/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/pages/sweet-alerts.init.js') }}"></script>

    <script src="{{ URL::asset('/assets/admin/labels/label-update.js') }}"></script>

@endsection
