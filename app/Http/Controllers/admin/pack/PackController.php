<?php

namespace App\Http\Controllers\admin\pack;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\StorePack;
use App\Models\Pack;

class PackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \View::make('admin.pack.packs-list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \View::make('admin.pack.pack-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePack $request)
    {
        $validatedData = $request->validated();
        $couponModel = new Pack();
        $couponModel->title = $validatedData['title'];
        $couponModel->identifier = $validatedData['identifier'];
        $couponModel->publisher = $validatedData['publisher'];
        $couponModel->status = '1';
        $couponModel->created_by = Auth::id();

        if($couponModel->save()){
            return response()->json(['status'=>'200' , 'message' => 'category created successfully.'] , 200);

        }else{
            return response()->json(['status'=>'400' , 'message' => 'Error! Please try again.'] , 200);

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
        $deleteRecord =  Pack::find($id);

        if($deleteRecord->delete()){
            return response()->json('Your Record has been deleted.' , 200);

        }else{
            return response()->json(  'error occured please try again' , 200);

        }
    }

    public function datatable()
    {
        return \response()->json(Pack::all() , 200);

    }

    public function select2Categories(Request $request)
    {
       return response()->json(Pack::where('title','like',"%$request->searchTerm%")->get(['id' , 'title']));
    }
}
