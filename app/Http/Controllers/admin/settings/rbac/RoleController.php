<?php

namespace App\Http\Controllers\admin\settings\rbac;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\StoreRole;
use App\Http\Requests\UpdateRole;
use Illuminate\Support\Facades\Auth;
use JavaScript;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \View::make('admin.settings.rbac.roles.roles-list');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \View::make('admin.settings.rbac.roles.role-create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRole $request)
    {
        $validatedData = $request->validated();

        Role::create([
            'name' => $validatedData['role'],
            'guard_name' => 'web',
            'status' => '1',
            'created_by' => Auth::id(),

        ]);

        return \response()->json(['status'=>'true' , 'message'=>'Role added successfully' ]);
    }


    // ********************* sort the permissions ***********************

    private static  function cmp($a, $b)
    {

        return strcmp($a["name"] , $b['name']);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // ****************** get all permissions **************

        $allPermissions = Permission::all()->toArray();
        $roleId = $id;
        // ******************************


        usort($allPermissions, array($this,'cmp'));
        $count = count($allPermissions);
        for ($i=0; $i < $count ; $i+=4 ) {
            $allPermissions[$i];
            $temp = $allPermissions[$i+1];
            $allPermissions[$i+2];
            $allPermissions[$i+1] = $allPermissions[$i+3];
            $allPermissions[$i+3] = $temp;

        }

        JavaScript::put([
            'roleId' => $id,

        ]);

        $roleAllPermissions = Role::findByName(Role::find($id)->name)->permissions;

        return \View::make('admin.settings.rbac.roles.role-show' , compact('allPermissions' , 'roleAllPermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        JavaScript::put([
            'id' => $id,
        ]);
        $singlRecord  =  Role::find($id);
        return \View::make('admin.settings.rbac.roles.role-edit' , compact('singlRecord'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRole $request, $id)
    {
        $validatedData = $request->validated();

        $roleModel = Role::find($id);

        $roleModel->name = $validatedData['role'];
        $roleModel->updated_by = Auth::id();

        if($roleModel->save()){
            return response()->json(['status'=>'true' , 'message' => 'Role updated successfully.'] , 200);

        }else{
            return response()->json(['status'=>'true' , 'message' => 'Error! Please try again.'] , 200);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteRecord =  Role::find($id);

        if($deleteRecord->delete()){
            return response()->json('Your Role has been deleted.' , 200);

        }else{
            return response()->json('error occured please try again' , 200);

        }
    }

    // ************************ datatbale ******************

    public function datatable()
    {
        return \response()->json(Role::all() , 200);

    }


    // ********************** change status **********************

    public function ChangeStatus(Request $request)
    {
        $changeStatus =  Role::find($request->id);
        $changeStatus->status = ( ($request->status == '0') ? '0' : '1');

        if($changeStatus->save()){
            return response()->json('You change the status of role successfully.' , 200);

        }else{
            return response()->json(  'error occured please try again' , 200);

        }

    }

    public function select2(Request $request)
    {
        return response()->json(Role::where('name','like',"%$request->searchTerm%")->
                                      where('status' , '1')->
                                    get(['id' , 'name']));
            # code...
    }


    // ************************ assign permission to eacch role *****************

    public function assignPermissionToRole(Request $request)
    {
        $validatedData = $request->validate([
            'permission' => 'required|numeric',
            'role' => 'required|numeric',
            'status' => 'required',
        ]);

        $role = Role::find($validatedData['role']);
        $permission = Permission::find($validatedData['permission']);

        if ($validatedData['status'] == 'checked') {

            $role->givePermissionTo($permission->name);
            return 'permission give succfully';
        }else{
            $role->revokePermissionTo($permission->name);
            return 'permission revoke succfully';

        }
    }

}
