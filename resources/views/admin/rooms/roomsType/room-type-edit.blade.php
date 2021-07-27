@extends('admin.layouts.master')

@section('title') @lang('translation.Form_Validation') @endsection


@section('css')

<link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('/assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    .select2 {
        width: 100% !important;
    }
    .swal-wide{
        width: 200px;
        height: 100px;
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

                        @method('PATCH')
                        @csrf
                      <div class="row">
                        <input type="hidden" id="method" name="_method" value="PATCH">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label class="control-label">Hotel </label> <br>
                                <select class="form-control select2" id="hotel" name="hotel">
                                <option value="{{ $singleRecord->hotel_id }}"> {{ $singleRecord->hotel->name}} </option>

                                </select>
                            </div>

                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                              <label>Room Type</label>
                            <input type="text" class="form-control" required placeholder="Please enter room type here" name="roomType" id="roomType" value=" {{ $singleRecord->room_type_name}} "/>
                        </div>

                        </div>

                      </div>

                      <div class="row">

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                              <label>Price Per Room</label>
                            <input type="text" class="form-control" required placeholder="Please enter price per room here" name="pricePerRoom" id="pricePerRoom" value="{{ $singleRecord->price_per_room}}" />
                        </div>

                        </div>


                      </div>

                       <div class="row">

                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                              <label>Description</label>
                                <textarea  class="form-control" rows="3" name="description" id="description"> {{ $singleRecord->description}} </textarea>

                        </div>

                        </div>

                      </div>

                      {{-- ******************* pics upload ************************** --}}

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

<script>
    var assetBaseUrl = "{{ asset('storage/') }}";
</script>

<script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>

<script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}"></script>


    {{-- <script src="{{ URL::asset('/assets/libs/gmaps/gmaps.min.js') }}"></script> --}}

    <script src="{{ URL::asset('/assets/js/jquery.validate/jquery.validate.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/notify.js') }}"></script>

    <script src="{{ URL::asset('/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/pages/sweet-alerts.init.js') }}"></script>

    <script src="{{ URL::asset('/assets/admin/rooms/roomsType/room-type-edit.js') }}"></script>


@endsection
