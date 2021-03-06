@extends('admin.layouts.master')

@section('title') @lang('translation.Form_Validation') @endsection


@section('css')

<link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/css/bootstrap-tagsinput.css') }}" rel="stylesheet" type="text/css" />

<style>
    .select2 {
        width: 100% !important;
    }
    .swal-wide{
        width: 200px;
        height: 100px;
    }
    .bootstrap-tagsinput .tag {
        margin-right: 2px;
    /* color: white; */
      background-color: #626ed4;
      border-radius: 5px;
      padding-left: 7px;
      padding-right: 7px;
      padding-bottom: 2px;



    /* display: inline-block; */
    }

    .bootstrap-tagsinput {
    display: block;
    width: 100%;
    height: calc(1.5em + 0.75rem + 2px);
    padding: 0.375rem 0.75rem;
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    -webkit-transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

</style>
@endsection

@section('content')

    <!-- start page title -->
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4 class="font-size-18">Create Room</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">S Chalet</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Rooms</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Rooms List</a></li>
                    <li class="breadcrumb-item active">Room  Create</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <form class="formCreateRoom" id="formCreateRoom">
                        @csrf
                      <div class="row">

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label class="control-label">Hotel </label> <br>
                                <select class="form-control select2" id="hotel" name="hotel" reequired>
                                    <option value=""> </option>

                                </select>
                            </div>

                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label class="control-label">Room Type </label> <br>
                                <select class="form-control select2" id="roomType" name="roomType" id="roomType" required>
                                    <option value=""> </option>

                                </select>
                            </div>

                        </div>


                    </div>

                    <div class="row">

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                              <label>Floor </label>
                            <input type="text" class="form-control" placeholder="Please enter enetr floor here" name="floor"/>
                        </div>

                        </div>

                    </div>


                    <div class="row">

                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                              <label>Description ( <small class="text-danger"> <i> optional* </i> </small> ) </label>
                                <textarea  class="form-control" rows="3" name="description" id="description"></textarea>

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

    <script src="{{ URL::asset('/assets/js/notify.js') }}"></script>

    <script src="{{ URL::asset('/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/pages/sweet-alerts.init.js') }}"></script>

    <script src="{{ URL::asset('/assets/admin/rooms/rooms/room-create.js') }}"></script>

@endsection
