@extends('admin.layouts.master')

@section('title') @lang('translation.Form_Validation') @endsection


@section('css')

    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('/assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/bootstrap-tagsinput/src/jquery.tagsinput.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/dropify-master/dist/css/dropify.css') }}" rel="stylesheet" type="text/css" />

    <style>
        .select2 {
        width: 100% !important;
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
                <h4 class="font-size-18">Update Site Setting</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">setting</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">setting</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">update site setting</a></li>
                    <li class="breadcrumb-item active">update site setting</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <form class="formCreateSiteSetting" id="formCreateSiteSetting">
                        @csrf

                        <!-- Nav tabs -->
                    <ul class="nav nav-pills nav-justified" role="tablist">
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link active" data-toggle="tab" href="#app-setting" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                <span class="d-none d-sm-block">App Setting</span>
                            </a>
                        </li>
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link" data-toggle="tab" href="#site_intro" role="tab">
                                <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                <span class="d-none d-sm-block">Site Intro</span>
                            </a>
                        </li>
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link" data-toggle="tab" href="#own_sticker" role="tab">
                                <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                <span class="d-none d-sm-block">Own Sticker</span>
                            </a>
                        </li>
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link" data-toggle="tab" href="#meta_tags" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                <span class="d-none d-sm-block">Meta Tags</span>
                            </a>
                        </li>
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link" data-toggle="tab" href="#team_members" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                <span class="d-none d-sm-block">Team Members</span>
                            </a>
                        </li>
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link" data-toggle="tab" href="#portfolio" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                <span class="d-none d-sm-block">Portfolio</span>
                            </a>
                        </li>
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link" data-toggle="tab" href="#basic_info" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                <span class="d-none d-sm-block">Basic Info</span>
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active p-3" id="app-setting" role="tabpanel">
                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>App Name</label>
                                        <input type="text" id="app_name" class="form-control" placeholder="Please enter app name"
                                            name="app_name" value="{{Setting::get('app_name')}}" />
                                    </div>

                                </div>

                            </div>
                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Admob Banner Id</label>
                                        <input type="text" id="admob_banner_id" class="form-control" placeholder="Please enter admob banner id"
                                            name="admob_banner_id" value="{{Setting::get('admob_banner_id')}}" />
                                    </div>

                                </div>

                            </div>
                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Admob Interstitial Id</label>
                                        <input type="text" id="admob_interstitial_id" class="form-control" placeholder="Please enter admob interstitial id"
                                            name="admob_interstitial_id" value="{{Setting::get('admob_interstitial_id')}}" />
                                    </div>

                                </div>

                            </div>
                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Admob Rewarded Id</label>
                                        <input type="text" id="admob_rewarded_id" class="form-control" placeholder="Please enter admob reward id"
                                            name="admob_rewarded_id" value="{{Setting::get('admob_rewarded_id')}}" />
                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label class="d-block mb-3">Admob Status :</label>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="Configs_admob_status_1" name="admob_status" value="1"
                                                class="custom-control-input">
                                            <label class="custom-control-label" for="Configs_admob_status_1">Yes</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="Configs_admob_status_0" name="admob_status" value="0"
                                                class="custom-control-input">
                                            <label class="custom-control-label" for="Configs_admob_status_0">No</label>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>App Version </label>
                                        <input type="text" id="app_version" class="form-control" placeholder="Please enter app version"
                                            name="app_version" value="{{Setting::get('app_version')}}" />
                                    </div>

                                </div>

                            </div>
                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>App Message </label>
                                        <input type="text" id="app_message" class="form-control" placeholder="Please enter app message"
                                            name="app_message" value="{{Setting::get('app_message')}}" />
                                    </div>

                                </div>

                            </div>
                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>App Purchase Code </label>
                                        <input type="text" id="app_purchase_code" class="form-control" placeholder="Please enter app purchase code"
                                            name="app_purchase_code" value="{{Setting::get('app_purchase_code')}}" />
                                    </div>

                                </div>

                            </div>
                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Product Id </label>
                                        <input type="text" id="product_id" class="form-control" placeholder="Please enter app product id"
                                            name="product_id" value="{{Setting::get('product_id')}}" />
                                    </div>

                                </div>

                            </div>
                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Server Key </label>
                                        <input type="text" id="server_key" class="form-control" placeholder="Please enter server key"
                                            name="server_key" value="{{Setting::get('server_key')}}" />
                                    </div>

                                </div>

                            </div>
                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label class="d-block mb-3">App Is Maintance?</label>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="Configs_is_maintance_1" name="is_maintance" value="1"
                                                class="custom-control-input">
                                            <label class="custom-control-label" for="Configs_is_maintance_1">Yes</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="Configs_is_maintance_0" name="is_maintance" value="0"
                                                class="custom-control-input">
                                            <label class="custom-control-label" for="Configs_is_maintance_0">No</label>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>



                        <div class="tab-pane p-3" id="site_intro" role="tabpanel">
                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Intro Title</label>
                                        <input type="text" id="site_slider_title" class="form-control" placeholder="Please enter intro title"
                                            name="site_slider_title" value="{{Setting::get('site_slider_title')}}" />
                                    </div>

                                </div>

                            </div>
                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Intro Description</label>
                                        <input type="text" id="site_slider_desc" class="form-control" placeholder="Please enter intro description"
                                            name="site_slider_desc" value="{{Setting::get('site_slider_desc')}}" />
                                    </div>

                                </div>

                            </div>
                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Intro Button Link</label>
                                        <input type="text" id="site_slider_button_link" class="form-control" placeholder="Please enter intro button link"
                                            name="site_slider_button_link" value="{{Setting::get('site_slider_button_link')}}" />
                                    </div>

                                </div>

                            </div>
                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Intro Background Color</label>
                                        <input type="text" id="site_slider_background_color" class="form-control" placeholder="Please enter intro background color"
                                            name="site_slider_background_color" value="{{Setting::get('site_slider_background_color')}}" />
                                    </div>

                                </div>

                            </div>
                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Intro Image</label>
                                        <input type="file"  data-height="200" name="site_slider_images[]" id="site_slider_images" multiple/>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="tab-pane p-3" id="own_sticker" role="tabpanel">
                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" id="site_service_title" class="form-control" placeholder="Please enter title"
                                            name="site_service_title" value="{{Setting::get('site_service_title')}}" />
                                    </div>

                                </div>

                            </div>
                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <input type="text" id="site_service_description" class="form-control" placeholder="Please enter description"
                                            name="site_service_description" value="{{Setting::get('site_service_description')}}" />
                                    </div>

                                </div>

                            </div>
                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>First Section Title</label>
                                        <input type="text" id="site_service_first_title" class="form-control" placeholder="Please enter first section title"
                                            name="site_service_first_title" value="{{Setting::get('site_service_first_title')}}" />
                                    </div>

                                </div>

                            </div>
                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>First Section Icon</label>
                                        <input type="text" id="site_service_first_icon" class="form-control" placeholder="Please enter first section icon"
                                            name="site_service_first_icon" value="{{Setting::get('site_service_first_icon')}}" />
                                    </div>

                                </div>

                            </div>
                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>First Section Description</label>
                                        <input type="text" id="site_service_first_description" class="form-control" placeholder="Please enter first section description"
                                            name="site_service_first_description" value="{{Setting::get('site_service_first_description')}}" />
                                    </div>

                                </div>

                            </div>
                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Second Section Title</label>
                                        <input type="text" id="site_service_second_title" class="form-control" placeholder="Please enter second section title"
                                            name="site_service_second_title" value="{{Setting::get('site_service_second_title')}}" />
                                    </div>

                                </div>

                            </div>
                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Second Section Icon</label>
                                        <input type="text" id="site_service_second_icon" class="form-control" placeholder="Please enter second section icon"
                                            name="site_service_second_icon" value="{{Setting::get('site_service_second_icon')}}" />
                                    </div>

                                </div>

                            </div>
                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Second Section Description</label>
                                        <input type="text" id="site_service_second_description" class="form-control" placeholder="Please enter second section description"
                                            name="site_service_second_description" value="{{Setting::get('site_service_second_description')}}" />
                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Third Section Title</label>
                                        <input type="text" id="site_service_third_title" class="form-control" placeholder="Please enter third section title"
                                            name="site_service_third_title" value="{{Setting::get('site_service_third_title')}}" />
                                    </div>

                                </div>

                            </div>
                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Third Section Icon</label>
                                        <input type="text" id="site_service_third_icon" class="form-control" placeholder="Please enter third section icon"
                                            name="site_service_third_icon" value="{{Setting::get('site_service_third_icon')}}" />
                                    </div>

                                </div>

                            </div>
                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Third Section Description</label>
                                        <input type="text" id="site_service_third_description" class="form-control" placeholder="Please enter third section description"
                                            name="site_service_third_description" value="{{Setting::get('site_service_third_description')}}" />
                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Fourth Section Title</label>
                                        <input type="text" id="site_service_fourth_title" class="form-control" placeholder="Please enter fourth section title"
                                            name="site_service_fourth_title" value="{{Setting::get('site_service_fourth_title')}}" />
                                    </div>

                                </div>

                            </div>
                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Fourth Section Icon</label>
                                        <input type="text" id="site_service_fourth_icon" class="form-control" placeholder="Please enter fourth section icon"
                                            name="site_service_fourth_icon" value="{{Setting::get('site_service_fourth_icon')}}" />
                                    </div>

                                </div>

                            </div>
                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Fourth Section Description</label>
                                        <input type="text" id="site_service_fourth_description" class="form-control" placeholder="Please enter fourth section description"
                                            name="site_service_fourth_description" value="{{Setting::get('site_service_fourth_description')}}" />
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="tab-pane p-3" id="meta_tags" role="tabpanel">
                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Type</label>
                                        <input type="text" id="og_type" class="form-control" placeholder="Please enter type"
                                            name="og_type" value="{{Setting::get('og_type')}}" />
                                    </div>

                                </div>

                            </div>
                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Url</label>
                                        <input type="text" id="og_url" class="form-control" placeholder="Please enter url"
                                            name="og_url" value="{{Setting::get('og_url')}}" />
                                    </div>

                                </div>

                            </div>
                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Site Name</label>
                                        <input type="text" id="og_site_name" class="form-control" placeholder="Please enter site name"
                                            name="og_site_name" value="{{Setting::get('og_site_name')}}" />
                                    </div>

                                </div>

                            </div>
                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Site Title</label>
                                        <input type="text" id="og_title" class="form-control" placeholder="Please enter site title"
                                            name="og_title" value="{{Setting::get('og_title')}}" />
                                    </div>

                                </div>

                            </div>
                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file"  data-height="200" name="og_image" id="og_image" />
                                    </div>

                                </div>
                            </div>
                        </div>




                        <div class="tab-pane p-3" id="team_members" role="tabpanel">
                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Section Title </label>
                                        <input type="text" id="site_team_section_title" class="form-control" placeholder="Please enter section title"
                                            name="site_team_section_title" value="{{Setting::get('site_team_section_title')}}" />
                                    </div>

                                </div>

                            </div>
                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Section Short Description</label>
                                        <input type="text" id="site_team_section_short_description" class="form-control" placeholder="Please enter section short description"
                                            name="site_team_section_short_description" value="{{Setting::get('site_team_section_short_description')}}" />
                                    </div>

                                </div>

                            </div>
                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Section Description</label>
                                        <input type="text" id="site_team_section_description" class="form-control" placeholder="Please enter section description"
                                            name="site_team_section_description" value="{{Setting::get('site_team_section_description')}}" />
                                    </div>

                                </div>

                            </div>
                        </div>




                        <div class="tab-pane p-3" id="portfolio" role="tabpanel">
                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Title </label>
                                        <input type="text" id="portfolio_section_title" class="form-control" placeholder="Please enter  title"
                                            name="portfolio_section_title" value="{{Setting::get('portfolio_section_title')}}" />
                                    </div>

                                </div>

                            </div>
                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <input type="text" id="portfolio_section_description" class="form-control" placeholder="Please enter  description"
                                            name="portfolio_section_description" value="{{Setting::get('portfolio_section_description')}}" />
                                    </div>

                                </div>

                            </div>
                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Limit</label>
                                        <input type="text" id="portfolio_section_count_limit" class="form-control" placeholder="Please enter limit"
                                            name="portfolio_section_count_limit" value="{{Setting::get('portfolio_section_count_limit')}}" />
                                    </div>

                                </div>

                            </div>
                        </div>



                        <div class="tab-pane p-3" id="basic_info" role="tabpanel">
                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Facebook </label>
                                        <input type="text" id="facebook" class="form-control" placeholder="Please enter  facebook link"
                                            name="facebook" value="{{Setting::get('facebook')}}" />
                                    </div>

                                </div>

                            </div>
                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Twitter</label>
                                        <input type="text" id="twitter" class="form-control" placeholder="Please enter  twitter link"
                                            name="twitter" value="{{Setting::get('twitter')}}" />
                                    </div>

                                </div>

                            </div>
                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Linkedin</label>
                                        <input type="text" id="linkedin" class="form-control" placeholder="Please enter linkedin link"
                                            name="linkedin" value="{{Setting::get('linkedin')}}" />
                                    </div>

                                </div>

                            </div>
                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Terms of Usage</label>
                                        <input type="text" id="terms_of_usage" class="form-control" placeholder="Please enter terms of usage"
                                            name="terms_of_usage" value="{{Setting::get('terms_of_usage')}}" />
                                    </div>

                                </div>

                            </div>
                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Privacy Policy</label>
                                        <input type="text" id="privacy_policy" class="form-control" placeholder="Please enter privacy policy"
                                            name="privacy_policy" value="{{Setting::get('privacy_policy')}}" />
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>



                        <div class="form-group mt-3">
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
    <script src="{{ URL::asset('assets/js/jquery.validate/additional-methods.min.js')}}"></script>
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/bootstrap-tagsinput/src/jquery.tagsinput.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/dropify-master/dist/js/dropify.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/notify.js') }}"></script>

    <script src="{{ URL::asset('/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/pages/sweet-alerts.init.js') }}"></script>

    <script src="{{ URL::asset('/assets/libs/dropzone/dropzone.min.js') }}"></script>


    <script src="{{ URL::asset('/assets/admin/site-setting/create.js') }}"></script>

@endsection
