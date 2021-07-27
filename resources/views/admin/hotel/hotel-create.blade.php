@extends('admin.layouts.master')

@section('title') @lang('translation.Form_Validation') @endsection


@section('css')


@endsection

@section('content')

    <!-- start page title -->
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4 class="font-size-18">Create Hotel</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">S Chalet</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Hotel List</a></li>
                    <li class="breadcrumb-item active">Hotel Create</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <form class="formCreateHotel" id="formCreateHotel" action="#">
                        @csrf
                      <div class="row">

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                              <label>Hotel Title</label>
                            <input type="text" class="form-control" required placeholder="Please enter hotel name here" name="name" />
                        </div>

                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                              <label>Phone Number</label>
                            <input type="text" class="form-control" required placeholder="Please enter state name here" name="phoneNo" />
                        </div>

                        </div>

                      </div>

                      <div class="row">

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                              <label>E-Mail</label>
                            <input type="text" class="form-control" required placeholder="Please enter hotel email here" name="email" />
                        </div>

                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                              <label>State</label>

                            <select class="form-control" required name="state" / >
                                <option value=""> -- State -- </option>
                                <option value="Punjab">Punjab</option>
                                <option  value="Sindh">Sindh</option>
                                <option value="Khyber Pakhtunkhwa">Khyber Pakhtunkhwa</option>
                                <option value="Balochistan">Balochistan</option>
                                <option value="Gilgit-Baltistan">Gilgit-Baltistan</option>
                                <option value="Azad Jammu and Kashmir">Azad Jammu and Kashmir</option>
                            </select>
                        </div>

                        </div>

                      </div>

                       <div class="row">

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                              <label>City</label>
                            <input type="text" class="form-control" required placeholder="Please enter  city here" name="city" />
                        </div>

                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                              <label>Zip Code</label>
                            <input type="text" class="form-control" required placeholder="Please enter  zipcode here" name="zipCode" />
                        </div>

                        </div>

                      </div>

                       <div class="row">

                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                              <label>Address</label>
                            <input type="text" class="form-control" required placeholder="Please enter hotel address here" name="address" />
                        </div>

                        </div>

                      </div>

                       <div class="row">

                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                              <label>Description</label>
                                <textarea  class="form-control" rows="3" name="description"></textarea>

                        </div>

                        </div>

                      </div>
                      {{-- *************** maps ******************* --}}
                      <div class="row mb-3">
                          <div class="col-md-12 col-lg-12">
                            <div id="map" class="gmaps"></div>

                          </div>

                      </div>
                        <div class="form-group mb-0">
                            <div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
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
    <!-- Plugins js -->
    <script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChnfBFd2XKk3E6sgBvSWt-Fd2mIsBxpDo&callback=initMap&libraries=&v=weekly"
      defer
    ></script>

    {{-- <script src="{{ URL::asset('/assets/libs/gmaps/gmaps.min.js') }}"></script> --}}

    <script src="{{ URL::asset('/assets/js/jquery.validate/jquery.validate.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/notify.js') }}"></script>

    <script src="{{ URL::asset('/assets/admin/hotel/hotel-create.js') }}"></script>
    <script src="{{ URL::asset('/assets/admin/hotel/google-maps.js') }}"></script>


@endsection
