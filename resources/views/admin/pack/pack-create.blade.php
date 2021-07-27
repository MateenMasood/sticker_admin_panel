@extends('admin.layouts.master')

@section('title') @lang('translation.Form_Validation') @endsection


@section('css')

    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/css/bootstrap-tagsinput.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />

@endsection

@section('content')

    <!-- start page title -->
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4 class="font-size-18">Add New Category</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">sticker</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">categories</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">categories list</a></li>
                    <li class="breadcrumb-item active">create category</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <form class="formCreateCategory" id="formCreateCategory">
                        @csrf
                        <div class="row">

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" placeholder="Please enter category title"
                                        name="title" />
                                </div>

                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Identifier</label>
                                    <input type="text" class="form-control" required
                                        placeholder="" value="" name="identifier" />
                                </div>

                            </div>

                        </div>
                        <div class="row">

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Publisher</label>
                                    <input type="text" class="form-control" required
                                        placeholder="Please enter category Publisher" name="publisher" />
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


    {{-- <script src="{{ URL::asset('/assets/libs/gmaps/gmaps.min.js') }}"></script> --}}

    <script src="{{ URL::asset('/assets/js/jquery.validate/jquery.validate.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/notify.js') }}"></script>

    <script src="{{ URL::asset('/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/pages/sweet-alerts.init.js') }}"></script>

    <script src="{{ URL::asset('/assets/admin/pack/pack-create.js') }}"></script>

@endsection
