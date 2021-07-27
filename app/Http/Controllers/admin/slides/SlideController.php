<?php

namespace App\Http\Controllers\admin\slides;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSlide;
use App\Models\Slide;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Str;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.slides.slides-list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slides.slide-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSlide $request)
    {
        try{
        $validatedData = $request->validated();
        $images=array();
        foreach($request->file as  $file){

            $name = Str::uuid().'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/slides' , $name);
            $size= $file->getSize();
            $extension= $file->getClientOriginalExtension();
            $type= $file->getMimeType();

            $fileAttributes=array('name' => $name, 'path' => $path, 'extension' => $extension,
             'size' => $size, 'type' => $type);

             array_push($images, $fileAttributes);
        }


        $slide = new Slide();
        $slide->title = $validatedData['title'];
        $slide->images =  json_encode($images);
        $slide->status = '1';
        $slide->created_by = Auth::id();

            if($slide->save()){
                return response()->json(['status'=>'200' , 'message' => 'slide created successfully.'] , 200);

            }else{
                return response()->json(['status'=>'400' , 'message' => 'Error! Please try again.'] , 200);

            }

        } catch (Exception $e) {

                return response()->json([ 'status'=>'500' , "message" =>$e->errorInfo[2]  ] ,500);

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
        //
    }

    public function datatable()
    {
        return \response()->json(Slide::all() , 200);
    }
}
