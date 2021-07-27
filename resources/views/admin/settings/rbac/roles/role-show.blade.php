@extends('admin.layouts.master')

@section('title') @lang('translation.Data_Table') @endsection

@section('css')
    <!-- datatables css -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

    <!-- start page title -->
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4 class="font-size-18">Assign Permissions</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">S Chalet</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Settings</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Rbac</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Roles</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Roles List</a></li>
                    <li class="breadcrumb-item active">Assign Permission To Roles</li>
                </ol>
            </div>
        </div>

        {{-- <div class="col-sm-6">
            <div class="float-right d-none d-md-block">

                <div class="dropdown">
                    <a href="{{ url('admin\rbac\roles\create')}}"><button class="btn btn-primary " type="button"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="mdi mdi-settings mr-2"></i> Assign Permission To Role
                    </button> </a>
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
        </div> --}}
    </div>
    <!-- end page title -->


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <table id="tblAssignPermissionToRole" class="table table-striped table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" width="70%">Permissions </th>
                                <th class="text-center" scope="col">Create</th>
                                <th class="text-center" scope="col">View</th>
                                <th class="text-center" scope="col">Edit</th>
                                <th class="text-center" scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>



                            @for ($i=0; $i < count($allPermissions) ; $i++)


                            <tr>
                                <th scope="row">{{ substr($allPermissions[$i]['name'] , 0 , -6)}}</th>
                                <td>
                                    <div class=" custom-switch-secondary mb-2 custom-switch-small " style="text-align: center;">
                                        <input class="custom-switch-input"  type="checkbox" onchange="assignPermission('{{$allPermissions[$i]['id'] }}')" @for($j=0 ; $j<count($roleAllPermissions); $j++) {{ ($roleAllPermissions[$j]['id'] == $allPermissions[$i]['id']) ? 'checked':''}} @endfor
                                            value="{{$allPermissions[$i++]['id'] }}" id="permissionStatus{{$i}}" name="permissionStatus"  >
                                        <label class="custom-switch-btn" for="permissionStatus{{$i}}"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center custom-switch-secondary mb-2 custom-switch-small">
                                        <input class="custom-switch-input"  type="checkbox" onchange="assignPermission('{{$allPermissions[$i]['id'] }}')" @for($j=0 ; $j<count($roleAllPermissions); $j++) {{ ($roleAllPermissions[$j]['id'] == $allPermissions[$i]['id']) ? 'checked':''}} @endfor
                                            value="{{$allPermissions[$i++]['id'] }}" id="permissionStatus{{$i}}" name="permissionStatus" >
                                        <label class="custom-switch-btn" for="permissionStatus{{$i}}"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center custom-switch-secondary mb-2 custom-switch-small">
                                        <input class="custom-switch-input"  type="checkbox" onchange="assignPermission('{{$allPermissions[$i]['id'] }}')" @for($j=0 ; $j<count($roleAllPermissions); $j++) {{ ($roleAllPermissions[$j]['id'] == $allPermissions[$i]['id']) ? 'checked':''}} @endfor
                                            value="{{$allPermissions[$i++]['id'] }}" id="permissionStatus{{$i}}" name="permissionStatus" >
                                        <label class="custom-switch-btn" for="permissionStatus{{$i}}"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center custom-switch-secondary mb-2 custom-switch-small">
                                        <input class="custom-switch-input"  type="checkbox" onchange="assignPermission('{{$allPermissions[$i]['id'] }}')" @for($j=0 ; $j<count($roleAllPermissions); $j++) {{ ($roleAllPermissions[$j]['id'] == $allPermissions[$i]['id']) ? 'checked':''}} @endfor
                                            value="{{$allPermissions[$i]['id'] }}" id="permissionStatuss{{$i}}" name="permissionStatus" >
                                        <label class="custom-switch-btn" for="permissionStatuss{{$i}}"></label>
                                    </div>
                                </td>
                            </tr>

                            @endfor

                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection

@section('script')
    <!-- Plugins js -->
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/pages/sweet-alerts.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/time.ago.js') }}"></script>

    <script src="{{ URL::asset('/assets/admin/settings/rbac/roles/role-show.js') }}"></script>

@endsection
