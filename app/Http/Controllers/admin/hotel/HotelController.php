<?php

namespace App\Http\Controllers\admin\hotel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Http\Requests\StoreHotel;
use App\Http\Requests\UpdateHotel;
use App\Models\Hotel;
use Illuminate\Support\Facades\Auth;


class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \View::make('admin.hotel.hotels-list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \View::make('admin.hotel.hotel-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHotel $request)
    {
        $validatedData = $request->validated();

        $hotelModel = new Hotel();

        $hotelModel->hotel_id = IdGenerator::generate(['table' => 'hotels', 'length' => 13, 'field' => 'hotel_id', 'prefix' => 'HTL-']);
        $hotelModel->name = $validatedData['name'];
        $hotelModel->phone_no = $validatedData['phoneNo'];
        $hotelModel->email = $validatedData['email'];
        $hotelModel->state = $validatedData['state'];
        $hotelModel->city = $validatedData['city'];
        $hotelModel->zip_code = $validatedData['zipCode'];
        $hotelModel->address = $validatedData['address'];
        $hotelModel->description = $request['description'];
        $hotelModel->status = '1';

        $hotelModel->created_by = Auth::id();

        if ($hotelModel->save()) {
            return response()->json(['status'=>'true' , 'message' => 'Hotel created successfully'] , 200);
        }else{
             return response()->json(['status'=>'errorr' , 'message' => 'error occured please try again'] , 200);
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
        $singlRecord  =  Hotel::find($id);
        return \View::make('admin.hotel.hotel-edit' , compact('singlRecord'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHotel $request, $id)
    {
        $validatedData = $request->validated();
        $hotelModel = Hotel::find($id);

        $hotelModel->name = $validatedData['name'];
        $hotelModel->phone_no = $validatedData['phoneNo'];
        $hotelModel->email = $validatedData['email'];
        $hotelModel->state = $validatedData['state'];
        $hotelModel->city = $validatedData['city'];
        $hotelModel->zip_code = $validatedData['zipCode'];
        $hotelModel->address = $validatedData['address'];
        $hotelModel->description = $request['description'];
        $hotelModel->status = '1';

        $hotelModel->updated_by = Auth::id();

        if ($hotelModel->save()) {
            return response()->json(['status'=>'true' , 'message' => 'Hotel updated successfully'] , 200);
        }else{
             return response()->json(['status'=>'errorr' , 'message' => 'error occured please try again'] , 200);
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
        $deleteRecord =  Hotel::find($id);

        if($deleteRecord->delete()){
            return response()->json(['status'=>'true' , 'message' => 'Your Record has been deleted.'] , 200);

        }else{
            return response()->json(['status'=>'error' , 'message' => 'error occured please try again'] , 200);

        }

    }

    public function datatable()
    {
        return \response()->json(Hotel::all() , 200);

    }

    // ************** selct2 ******************

    public function select2(Request $request)
    {
        return response()->json(Hotel::where('name','like',"%$request->searchTerm%")->
                                        where('status' , '1')->
                                    get(['id' , 'name']));
            # code...
    }


   // ********************** change status **********************

    public function ChangeStatus(Request $request)
    {
        $changeStatus =  Hotel::find($request->id);
        $changeStatus->status = ( ($request->status == '0') ? '0' : '1');

        if($changeStatus->save()){
            return response()->json('You change the status of Hotel code successfully.' , 200);

        }else{
            return response()->json(  'error occured please try again' , 200);

        }

    }
}
