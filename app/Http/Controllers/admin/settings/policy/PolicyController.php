<?php

namespace App\Http\Controllers\admin\settings\policy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Http\Requests\StorePolicy;
use App\Http\Requests\UpdatePolicy;
use App\Models\Policy;
use Illuminate\Support\Facades\Auth;
use JavaScript;

class PolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \View::make('admin.settings.policy.policies-list');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \View::make('admin.settings.policy.policy-create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePolicy $request)
    {
        $validatedData = $request->validated();
        $PolicyModel = new Policy();
        $PolicyModel->policy_id = IdGenerator::generate(['table' => 'policies', 'length' => 13, 'field' => 'policy_id', 'prefix' => 'POL-']);
        $PolicyModel->hotel_id = $validatedData['hotel'];
        $PolicyModel->title = $validatedData['title'];
        $PolicyModel->description = $validatedData['description'];
        $PolicyModel->status = '1';
        $PolicyModel->created_by = Auth::id();

        if($PolicyModel->save()){
            return response()->json(['status'=>'true' , 'message' => 'Policy created successfully.'] , 200);

        }else{
            return response()->json(['status'=>'true' , 'message' => 'Error! Please try again.'] , 200);

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

        $singleRecord = Policy::find($id);
        // dd($singleRecord->roomType);

        // $roomTypeImages = RoomTypeFile::where('room_type_id' , $id)->get();

        JavaScript::put([
            'id' => $id,
        ]);

        return \View::make('admin.settings.policy.policy-edit' , compact('singleRecord'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePolicy $request, $id)
    {
        $validatedData = $request->validated();

        $PolicyModel = Policy::find($id);

        $PolicyModel->hotel_id = $validatedData['hotel'];
        $PolicyModel->title = $validatedData['title'];
        $PolicyModel->description = $validatedData['description'];
        $PolicyModel->status = '1';
        $PolicyModel->updated_by = Auth::id();

        if($PolicyModel->save()){
            return response()->json(['status'=>'true' , 'message' => 'Policy updated successfully.'] , 200);

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
        $deleteRecord =  Policy::find($id);

        if($deleteRecord->delete()){
            return response()->json('Your Record has been deleted.' , 200);

        }else{
            return response()->json('error occured please try again' , 200);

        }
    }


    // ***************************** datatable ******************

    public function datatable()
    {
        return \response()->json(Policy::with('hotel')->get() , 200);

    }
}
