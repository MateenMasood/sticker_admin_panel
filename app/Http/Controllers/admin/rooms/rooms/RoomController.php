<?php

namespace App\Http\Controllers\admin\rooms\rooms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Http\Requests\StoreRoom;
use App\Http\Requests\UpdateRoom;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use JavaScript;
use Illuminate\Support\Facades\Config;



class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \View::make('admin.rooms.rooms.rooms-list');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \View::make('admin.rooms.rooms.room-create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoom $request)
    {

        $validatedData = $request->validated();
        $RoomTypeModel = new Room();
        $RoomTypeModel->room_id = IdGenerator::generate(['table' => 'rooms', 'length' => 13, 'field' => 'room_id', 'prefix' => 'RMI-']);
        $RoomTypeModel->room_type_id = $validatedData['roomType'];
        $RoomTypeModel->floor = $validatedData['floor'];
        $RoomTypeModel->is_available = Config::get('constants.is_available');;
        $RoomTypeModel->status = '1';
        $RoomTypeModel->created_by = Auth::id();

        if($RoomTypeModel->save()){
            return response()->json(['status'=>'true' , 'message' => 'Room created successfully.'] , 200);

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
        $roomSingleRecord = Room::find($id);
        // dd($singleRecord->roomType);

        // $roomTypeImages = RoomTypeFile::where('room_type_id' , $id)->get();

        JavaScript::put([
            'id' => $id,
            'roomSingleRecord' => $roomSingleRecord,
        ]);

        return \View::make('admin.rooms.rooms.room-edit' , compact('roomSingleRecord'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoom $request, $id)
    {
    
        $validatedData = $request->validated();

        $RoomModel = Room::find($id);

        $RoomModel->room_type_id = $validatedData['roomType'];
        $RoomModel->floor = $validatedData['floor'];
        $RoomModel->description = $request->description;
        $RoomModel->status = '1';
        $RoomModel->updated_by = Auth::id();

        if($RoomModel->save()){
            return response()->json(['status'=>'true' , 'message' => 'Room updated successfully.'] , 200);

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
        $deleteRecord =  Room::find($id);

        if($deleteRecord->delete()){
            return response()->json('Your Record has been deleted.' , 200);

        }else{
            return response()->json('error occured please try again' , 200);

        }
    }

    // ***************************** datatable ******************

    public function datatable()
    {
        return \response()->json(Room::with('roomType.hotel')->get() , 200);

    }
}
