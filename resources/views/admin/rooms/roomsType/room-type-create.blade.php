@extends('admin.layouts.master')

@section('title') @lang('translation.Form_Validation') @endsection


@section('css')

<link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('/assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/css/bootstrap-tagsinput.css') }}" rel="stylesheet" type="text/css" />


<link href="{{ URL::asset('assets/libs/bootstrap-fileinput-master/css/fileinput.min.css') }}" rel="stylesheet" type="text/css" />


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
                <h4 class="font-size-18">Create Rooms Type</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">S Chalet</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Rooms</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Rooms Type List</a></li>
                    <li class="breadcrumb-item active">Room Type Create</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <form class="formCreateRoomType" id="formCreateRoomType" enctype="multipart/form-data">
                        @csrf
                      <div class="row">

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label class="control-label">Hotel </label> <br>
                                <select class="form-control select2" id="hotel" name="hotel">
                                    <option value=""> </option>

                                </select>
                            </div>

                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                              <label>Room Type</label>
                            <input type="text" class="form-control" required placeholder="Please enter state name here" name="roomType" id="roomType"/>
                        </div>

                        </div>

                      </div>

                    <div class="row">

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                              <label>Number of Person Allowed</label>
                                <input type="text" class="form-control"  placeholder="Please enter the number of person allowd here" name="noOfPerson" id="noOfPerson" />
                            </div>

                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                              <label>Number of kids Allowed</label>
                                <input type="text" class="form-control"  placeholder="Please enter the number of kids allowed here" name="noOfKids" id="noOfKids" />
                            </div>

                        </div>


                    </div>

                    <div class="row">

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                              <label>Bed Type</label>
                                <input type="text" class="form-control"  placeholder="Please enter the bed type here" name="bedType" id="bedType" />
                            </div>

                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                              <label>Room Size</label>
                                <input type="text" class="form-control"  placeholder="Please enter the room size here" name="roomSize" id="roomSize" />
                            </div>

                        </div>


                    </div>


                    <div class="row">

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                              <label>Price Per Room</label>
                            <input type="text" class="form-control" required placeholder="Please enter hotel email here" name="pricePerRoom" id="pricePerRoom" />
                        </div>

                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                              <label>Tax ( <small class="text-danger" > <i> enter percent of tax here* </i>   </small> )</label>
                              <input type="text" class="form-control" required placeholder="Please enter tax in percentage here" name="tax" id="tax" />
                            </div>

                        </div>


                    </div>

                    <div class="row">

                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                              <label>Amenities</label> <br>
                              <input type="text" class="form-control-tags-input" data-role="tagsinput"  name="amenities" id="amenities" />


                        </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                              <label>Room Overview</label>
                                <textarea  class="form-control" rows="3" required name="description" id="description"></textarea>

                        </div>

                        </div>

                    </div>

                    <hr class="mb-4">
                    <h5><u> Policies </u>  </h5>
                    <div class="row mb-3">
                        <div class="col-md-12 col-lg-12">

                            <div class="repeater">
                                <div data-repeater-list="group_a">
                                    <div data-repeater-item class="row">
                                        <div class="form-group col-lg-4 col-md-4">
                                            <label for="policyTitle">Policy Title</label>
                                            <input type="text" placeholder="policy title" name="vehicle[0][name]" id="vehicle_0_name" data-pattern-name="vehicle[++][name]" data-pattern-id="vehicle_++_name" class="form-control" />
                                        </div>
        
                                        <div class="form-group col-lg-7 col-md-7">
                                            <label for="policyDescription">Policy Description</label>
                                            <input type="text" placeholder="policy detail" name="vehicle[0][type]" id="vehicle_0_type" data-pattern-name="vehicle[++][type]" data-pattern-id="vehicle_++_type" class="form-control" />
                                        </div>
        
        
                                        <div class="col-lg-1 align-self-center">
                                            <input data-repeater-delete type="button" class="btn btn-danger btn-block"
                                                value="Delete" />
                                        </div>
                                    </div>
        
                                </div>
                                <input data-repeater-create type="button" class="btn btn-success mo-mt-2" value="Add" id="addItem" />
    

                            </div>
                        </div>

                    </div>

                    {{-- ******************** hero section ***************************** --}}

                    <hr>

                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label for=""> Hero Section Image</label>
                                  <input id="roomTypeBackgroundPic" type="file" multiple name="roomTypeBackgroundPic">
                            </div>
                                

                        </div>

                    </div>

                      {{-- ******************* pics upload ************************** --}}

                      {{-- ********************************* rooms slider ******************** --}}
                      <hr>

                      <label for=""> Sliders </label>

                      <div class="row">
                          <div class="col-md-12 col-lg-12">
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


    {{-- <script src="{{ URL::asset('/assets/libs/gmaps/gmaps.min.js') }}"></script> --}}

    <script src="{{ URL::asset('/assets/js/jquery.validate/jquery.validate.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/notify.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jquery-repeater/jquery-repeater.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/libs/bootstrap-fileinput-master/js/fileinput.min.js') }}"></script>



    <script src="{{ URL::asset('/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/pages/sweet-alerts.init.js') }}"></script>

    <script src="{{ URL::asset('/assets/admin/rooms/roomsType/room-type-create.js') }}"></script>


@endsection
