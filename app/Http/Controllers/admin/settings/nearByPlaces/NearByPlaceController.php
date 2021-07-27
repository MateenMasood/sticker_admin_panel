<?php

namespace App\Http\Controllers\admin\settings\nearByPlaces;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\NearByPlace;
use App\Models\NearByPlaceFile;
use Illuminate\Support\Facades\Auth;
use JavaScript;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;



class NearByPlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \View::make('admin.settings.nearByPlaces.near-by-places-list');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \View::make('admin.settings.nearByPlaces.near-by-place-create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $validatedData = $request->validate([
            'hotelId' => 'required|numeric',
            'file.*' => 'required',
        ]);

        // ***************** start of transaction ************************

        DB::beginTransaction();

        try {

            $nearByPlaceModel = new NearByPlace();

            $nearByPlaceModel->near_by_place_id = IdGenerator::generate(['table' => 'near_by_places', 'length' => 13, 'field' => 'near_by_place_id', 'prefix' => 'SI-']);
            $nearByPlaceModel->hotel_id = $validatedData['hotelId'];
            $nearByPlaceModel->title = Config::get('constants.near_by_places_title');
            $nearByPlaceModel->status = '1';
            $nearByPlaceModel->created_by = Auth::id();


            $nearByPlaceModel->save();



        foreach($request->file as $key=> $file){

            $imageZone = '';
            if($key == '0'){
                $imageZone = 'baseImage';
            }else{
                $imageZone = 'optionalImage';
            }
            $imageName = Str::uuid().'.'.$file->getClientOriginalExtension();
            $imagePath = $file->storeAs('uploads/nearByPlacesImages' , $imageName);



            $nearByPlaceImageModel = new NearByPlaceFile();
            $nearByPlaceImageModel->near_by_place_id = $nearByPlaceModel->id;
            $nearByPlaceImageModel->near_by_place_file_id = IdGenerator::generate(['table' => 'near_by_place_files', 'length' => 13, 'field' => 'near_by_place_file_id', 'prefix' => 'SI-']);
            $nearByPlaceImageModel->path = $imagePath;
            $nearByPlaceImageModel->file_name = $imageName;
            $nearByPlaceImageModel->size = $file->getSize();
            $nearByPlaceImageModel->mime_type = $file->getMimeType();
            $nearByPlaceImageModel->extension = $file->getClientOriginalExtension();
            $nearByPlaceImageModel->zone = $imageZone;
            $nearByPlaceImageModel->status = '1';
            $nearByPlaceImageModel->created_by = Auth::id();


            $nearByPlaceImageModel->save();
        }
            DB::commit();

            return response()->json("near by places has been added successfully.");
        } catch (Exception $e) {

              DB::rollBack();
              return response()->json([  "error" =>$e->errorInfo[2]  ] ,406);

        }



        // ********************* end transcation *************************

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $singleNearByPlaceRecord = NearByPlace::find($id);


        // return $singleNearByPlaceRecord->nearByPlaceFile;
        return \View::make('admin.settings.nearByPlaces.near-by-place-view' , compact('singleNearByPlaceRecord'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
            
            $deleteRecord =  NearByPlace::find($id);
            $deleteRecord->delete();

            $deleteRecordFromNearByfilesModel = NearByPlaceFile::where('near_by_place_id' , $id);

            $deleteRecordFromNearByfilesModel->delete();



            DB::commit();

            return response()->json("Your Record has been deleted.");
        } catch (Exception $e) {

                DB::rollBack();
                return response()->json([  "error" =>$e->errorInfo[2]  ] ,406);

        }
    }

    // **************************** datatable ************************

    public function datatable()
    {
        return \response()->json(NearByPlace::with('hotel')->get() , 200);
    }


       // ********************** change status **********************

    public function ChangeStatus(Request $request)
    {
        $changeStatus =  NearByPlace::find($request->id);
        $changeStatus->status = ( ($request->status == '0') ? '0' : '1');

        if($changeStatus->save()){
            return response()->json('You change the status of the record successfully.' , 200);

        }else{
            return response()->json(  'error occured please try again' , 200);

        }

    }
}
