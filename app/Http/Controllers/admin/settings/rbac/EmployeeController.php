<?php

namespace App\Http\Controllers\admin\settings\rbac;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
use App\Models\Employee;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use JavaScript;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \View::make('admin.settings.rbac.users.users-list');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \View::make('admin.settings.rbac.users.user-create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        // return $request;
        $validatedData = $request->validated();

        DB::beginTransaction();
        try {

            $userModel = new User();
            $userModel->first_name = $validatedData['firstName'];
            $userModel->last_name = $validatedData['lastName'];
            $userModel->email = $validatedData['email'];
            $userModel->contact = $validatedData['phoneNo'];
            $userModel->password = Hash::make($validatedData['password']);
            $userModel->status = '1';

            $userModel->save();

            $employeeModel = new Employee();
            $employeeModel->employee_id = IdGenerator::generate(['table' => 'employees', 'length' => 13, 'field' => 'employee_id', 'prefix' => 'EMP-']);
            $employeeModel->user_id = $userModel->id;
            $employeeModel->age = $request->age;
            $employeeModel->address = $request->address;
            $employeeModel->status = '1';
            $employeeModel->created_by = Auth::id();

            $employeeModel->save();

            $roleModel = Role::find($validatedData['role']);

            $userModel->assignRole($roleModel->name);

            DB::commit();
            return \response()->json(['status'=>'true' , 'message'=>'User created successfully']);

        } catch (\Illuminate\Database\QueryException $exception ){
                DB::rollback();
                //throw $th;
                $errorInfo = $exception->errorInfo;

              // Return the response to the client..
                return $errorInfo[2];

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $singlRecord  =  Employee::find($id);
        JavaScript::put([
            'id' => $singlRecord->user->id,
        ]);
        // dd ($singlRecord->user->roles[0]->id);
        return \View::make('admin.settings.rbac.users.user-edit' , compact('singlRecord'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, $id)
    {
        // return Employee::where('user_id' , $id);
        // return Employee::where('user_id' , $id);
         $validatedData = $request->validated();

         DB::beginTransaction();
         try {

             $userModel = User::find($id);
             $userModel->first_name = $validatedData['firstName'];
             $userModel->last_name = $validatedData['lastName'];
             $userModel->email = $validatedData['email'];
             $userModel->contact = $validatedData['phoneNo'];
             $userModel->status = '1';

             $userModel->save();

             $employeeModel =  Employee::find($validatedData['employeeId']);
             $employeeModel->user_id = $userModel->id;
             $employeeModel->age = $request->age;
             $employeeModel->address = $request->address;
             $employeeModel->status = '1';
             $employeeModel->updated_by = Auth::id();

             $employeeModel->save();

             $roleModel = Role::find($validatedData['role']);

             $userModel->assignRole($roleModel->name);

             DB::commit();
             return \response()->json(['status'=>'true' , 'message'=>'User updated successfully']);

         } catch (\Illuminate\Database\QueryException $exception ){
                 DB::rollback();
                 //throw $th;
                 $errorInfo = $exception->errorInfo;

               // Return the response to the client..
                 return $errorInfo[2];

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
        DB::beginTransaction();
        try {

            $deleteRecord =  User::find($id);

            $deleteRecord->delete();

            $deleteRecordEmployeeModel = Employee::where('user_id' , $id);

            $deleteRecordEmployeeModel->delete();

            DB::commit();

            return response()->json("Your Record has been deleted.");

        } catch (\Illuminate\Database\QueryException $exception ){
            DB::rollback();
            //throw $th;
            $errorInfo = $exception->errorInfo;

          // Return the response to the client..
            return $errorInfo[2];

        }

    }

    public function datatable()
    {
        return \response()->json(Employee::with('user.roles')->get() , 200);

    }

    // ********************* chnage the staus of the employee ***************

        // ********************** change status **********************

        public function ChangeStatus(Request $request)
        {
            DB::beginTransaction();
            try {


                $changeUserStatusInEmployeeModel =  Employee::find($request->id);

                $changeUserStatusInUserModel = User::find($changeUserStatusInEmployeeModel->user->id);

                $changeUserStatusInUserModel->status = ( ($request->status == '0') ? '0' : '1');

                $changeUserStatusInUserModel->save();

                $changeUserStatusInEmployeeModel->status = ( ($request->status == '0') ? '0' : '1');

                $changeUserStatusInEmployeeModel->save();



             DB::commit();

            return response()->json("You change the status of user successfully");

        } catch (\Illuminate\Database\QueryException $exception ){
            DB::rollback();
            //throw $th;
            $errorInfo = $exception->errorInfo;

          // Return the response to the client..
            return $errorInfo[2];

        }

        }

}
