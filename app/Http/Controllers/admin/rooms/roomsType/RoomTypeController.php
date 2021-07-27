<?php

namespace App\Http\Controllers\admin\rooms\roomsType;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRoomType;
use App\Http\Requests\UpdateRoomType;
use Illuminate\Support\Facades\DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\RoomType;
use App\Models\RoomTypeFile;
use App\Models\RoomPolicy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;
use JavaScript;
use Illuminate\Support\Facades\File;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \View::make('admin.rooms.roomsType.rooms-type-list');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \View::make('admin.rooms.roomsType.room-type-create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoomType $request)
    { 

        $validatedData = $request->validated();

   
        $getRoomPoliciesArrayFromFormData = array();
        parse_str($request->roomPoicyTitle , $getRoomPoliciesArrayFromFormData);
   
        // ********** start transction ************
        DB::beginTransaction();

        try {
                $RoomTypeModel = new RoomType();
                $RoomTypeModel->room_type_id = IdGenerator::generate(['table' => 'room_types', 'length' => 13, 'field' => 'room_type_id', 'prefix' => 'HRTI-']);
                $RoomTypeModel->hotel_id = $validatedData['hotelId'];
                $RoomTypeModel->room_type_name = $validatedData['roomType'];
                $RoomTypeModel->price_per_room = $validatedData['pricePerRoom'];
                $RoomTypeModel->tax = $validatedData['tax'];

                $RoomTypeModel->no_of_person = $request->noOfPerson;
                $RoomTypeModel->no_of_kids = $request->noOfKids;
                $RoomTypeModel->room_size = $request->roomSize;
                $RoomTypeModel->bed_type = $request->bedType;
                $RoomTypeModel->aminities = $validatedData['amenities'];


                $RoomTypeModel->description = $validatedData['description'];
                $RoomTypeModel->status = '1';
                $RoomTypeModel->created_by = Auth::id();

                $RoomTypeModel->save();


                 // *********************** hero section image ***********************

                 $imageName = Str::uuid().'.'.$request->roomTypeBackgroundImage->getClientOriginalExtension();
                 $imagePath = $request->roomTypeBackgroundImage->storeAs('uploads/roomsTypeImages' , $imageName);
 
                 $RoomTypeFileModel = new RoomTypeFile();
                 $RoomTypeFileModel->room_type_file_id = IdGenerator::generate(['table' => 'room_type_files', 'length' => 13, 'field' => 'room_type_file_id', 'prefix' => 'HRTFI-']);
                 $RoomTypeFileModel->room_type_id = $RoomTypeModel->id;
                 $RoomTypeFileModel->path = $imagePath;
                 $RoomTypeFileModel->file_name = $imageName;
                 $RoomTypeFileModel->size = $request->roomTypeBackgroundImage->getSize();
                 $RoomTypeFileModel->mime_type = $request->roomTypeBackgroundImage->getMimeType();
                 $RoomTypeFileModel->extension = $request->roomTypeBackgroundImage->getClientOriginalExtension();
                 $RoomTypeFileModel->zone = 'hero section';
                 $RoomTypeFileModel->status = '1';
                 $RoomTypeFileModel->created_by = Auth::id();

                 $RoomTypeFileModel->save();

                foreach($request->file as $key=> $file){

                    $imageZone = '';
                    if($key == '0'){
                        $imageZone = 'baseImage';
                    }else{
                        $imageZone = 'optionalImage';
                    }
                    $imageName = Str::uuid().'.'.$file->getClientOriginalExtension();
                    $imagePath = $file->storeAs('uploads/roomsTypeImages' , $imageName);



                    $RoomTypeFileModel = new RoomTypeFile();
                    $RoomTypeFileModel->room_type_file_id = IdGenerator::generate(['table' => 'room_type_files', 'length' => 13, 'field' => 'room_type_file_id', 'prefix' => 'HRTFI-']);
                    $RoomTypeFileModel->room_type_id = $RoomTypeModel->id;
                    $RoomTypeFileModel->path = $imagePath;
                    $RoomTypeFileModel->file_name = $imageName;
                    $RoomTypeFileModel->size = $file->getSize();
                    $RoomTypeFileModel->mime_type = $file->getMimeType();
                    $RoomTypeFileModel->extension = $file->getClientOriginalExtension();
                    $RoomTypeFileModel->zone = $imageZone;
                    $RoomTypeFileModel->status = '1';
                    $RoomTypeFileModel->created_by = Auth::id();


                    $RoomTypeFileModel->save();
                }


                // *********** room policies *********************

                $roomPoliciesAssociativeArray = array();
                foreach ($getRoomPoliciesArrayFromFormData['group_a'] as $key => $value) {
          
                    // $roomPoliciesAssociativeArray[$value['name']] = $value['type'];

                    $roomPolicyModel = new RoomPolicy();
                    $roomPolicyModel->room_policy_id = IdGenerator::generate(['table' => 'room_policies', 'length' => 13, 'field' => 'room_policy_id', 'prefix' => 'RMP-']);
                    $roomPolicyModel->room_type_id = $RoomTypeModel->id;
                    $roomPolicyModel->policy_title = $value['name'];
                    $roomPolicyModel->policy_detail = $value['type'];
                    $roomPolicyModel->status = '1';
                    $roomPolicyModel->created_by = Auth::id();


                    $roomPolicyModel->save();
                    
          
                }

                    DB::commit();

                    return response()->json("Room type has been added successfully.");
        } catch (Exception $e) {

                DB::rollBack();
                return response()->json([  "error" =>$e->errorInfo[2]  ] ,406);

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
        $singleRecord = RoomType::find($id);

        $roomTypeImages = RoomTypeFile::where('room_type_id' , $id)->get();

        JavaScript::put([
            'images' => $roomTypeImages,
            'id' => $id,
            'roomTypeRecord' => $singleRecord,
        ]);

        return \View::make('admin.rooms.roomsType.room-type-edit' , compact('singleRecord'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoomType $request, $id)
    {

        $validatedData = $request->validated();

        // ********** start transction ************
        DB::beginTransaction();

        try {
                $RoomTypeModel =  RoomType::find($id);
                $RoomTypeModel->hotel_id = $validatedData['hotelId'];
                $RoomTypeModel->room_type_name = $validatedData['roomType'];
                $RoomTypeModel->price_per_room = $validatedData['pricePerRoom'];
                $RoomTypeModel->description = $request->description;
                $RoomTypeModel->status = '1';
                $RoomTypeModel->updated_by = Auth::id();

                $RoomTypeModel->save();

                // ************ find if base image already exist or not ********************
                $flag = '';
                $findBaseImage = RoomTypeFile::where(['room_type_id' => $id , 'zone' => 'baseImage'])->get();
                if($findBaseImage->isEmpty()){
                    $flag = true;
                }else{
                    $flag = false;
                }

               


                // $RoomTypeFileModel->save();

                foreach($request->file as $key=> $file){

                    $imageZone = '';
                    if($key == '0' && $flag == 'true'){
                        $imageZone = 'baseImage';
                    }else{
                        $imageZone = 'optionalImage';
                    }
                    $imageName = Str::uuid().'.'.$file->getClientOriginalExtension();
                    $imagePath = $file->storeAs('uploads/roomsTypeImages' , $imageName);



                    $RoomTypeFileModel = new RoomTypeFile();
                    $RoomTypeFileModel->room_type_file_id = IdGenerator::generate(['table' => 'room_type_files', 'length' => 13, 'field' => 'room_type_file_id', 'prefix' => 'HRTFI-']);
                    $RoomTypeFileModel->room_type_id = $RoomTypeModel->id;
                    $RoomTypeFileModel->path = $imagePath;
                    $RoomTypeFileModel->file_name = $imageName;
                    $RoomTypeFileModel->size = $file->getSize();
                    $RoomTypeFileModel->mime_type = $file->getMimeType();
                    $RoomTypeFileModel->extension = $file->getClientOriginalExtension();
                    $RoomTypeFileModel->zone = $imageZone;
                    $RoomTypeFileModel->status = '1';
                    $RoomTypeFileModel->created_by = Auth::id();


                    $RoomTypeFileModel->save();
                }

                    DB::commit();

                    return response()->json("Room type has been updated successfully.");
        } catch (Exception $e) {

                DB::rollBack();
                return response()->json([  "error" =>$e->errorInfo[2]  ] ,406);

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
                // ********** start transction ************
        DB::beginTransaction();

        try {

            $deleteRecord =  RoomType::find($id);

            $deleteRecord->delete();

            $deleteRecordFromfilesModel = RoomTypeFile::where('room_type_id' , $id);

            $deleteRecordFromfilesModel->delete();

            DB::commit();

            return response()->json("Your Record has been deleted.");
        } catch (Exception $e) {

                DB::rollBack();
                return response()->json([  "error" =>$e->errorInfo[2]  ] ,406);

    }

    }

    // *********************** datatable


    public function datatable()
    {
        return \response()->json(RoomType::with('hotel')->get() , 200);

    }


    // *********************************************

    public function roomTypeFileDelete(Request $request)
    {
        $deleteRoomTypeFile = RoomTypeFile::where('file_name' , $request->name);
        File::delete("storage/uploads/roomsTypeImages/$request->name");
        $deleteRoomTypeFile->delete();

    }


    // ************************ select2 *************************

    public function select2(Request $request)
    {
        // return $request;
        return response()->json(RoomType::where('hotel_id',$request->hotelId)->get(['id','room_type_name']));

    }
}
