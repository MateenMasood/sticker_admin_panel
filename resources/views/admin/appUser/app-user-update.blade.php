@extends('admin.layouts.master')

@section('title') @lang('translation.Form_Validation') @endsection


@section('css')

<link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/css/bootstrap-tagsinput.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet"/>

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
                <h4 class="font-size-18">Update App User</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">sticker</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">app users</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">app users list</a></li>
                    <li class="breadcrumb-item active">edit Coupon</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <form class="formEditCoupon" id="formEditCoupon">
                        @csrf
                      <div class="row">

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>User Key</label>
                                <input type="text" class="form-control" name="uderId" value="{{ $singlRecord->user_id }}" readonly/>
                            </div>

                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>First Login</label>
                                <input type="text" class="form-control" required name="firstLogin" value="{{ $singlRecord->first_login }}" readonly/>
                            </div>

                        </div>


                    </div>

                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-12 col-md-12">
                            <div class="col-md-12 col-lg-12">

                                <div class="form-group">
                                    <label>Admob Status</label>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="active"
                                            name="admobStatus" {{ ($singlRecord->admob_status == '1')? 'checked' : '' }}>
                                        <label class="custom-control-label" for="active">Active</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                    
                        <div class="col-lg-12 col-md-12">
                            <div class="col-md-12 col-lg-12">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="passive"
                                        name="admobStatus" {{ ($singlRecord->admob_status == '0')? 'checked' : '' }}>
                                    <label class="custom-control-label" for="passive">Passive</label>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-12 col-md-12">
                            <div class="col-md-12 col-lg-12">

                                <div class="form-group">
                                    <label>Purchase Status</label>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="activePrchaseStatus"
                                            name="purchaseStatus" {{ ($singlRecord->purchase_status == '1')? 'checked' : '' }}>
                                        <label class="custom-control-label" for="activePrchaseStatus">Active</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                    
                        <div class="col-lg-12 col-md-12">
                            <div class="col-md-12 col-lg-12">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="passivePrchaseStatus"
                                        name="purchaseStatus" {{ ($singlRecord->purchase_status == '0')? 'checked' : '' }}>
                                    <label class="custom-control-label" for="passivePrchaseStatus">Passive</label>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <div>
                            <button type="submit" id="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                Update
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

    <script src="{{ URL::asset('/assets/admin/appUser/app-user-update.js') }}"></script>

@endsection
