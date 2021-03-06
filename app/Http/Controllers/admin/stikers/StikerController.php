<?php

namespace App\Http\Controllers\admin\stikers;

use App\Http\Controllers\Controller;
use App\Models\Stiker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Str;
use App\Http\Requests\StoreSticker;
use JavaScript;
use Illuminate\Support\Facades\File;
class StikerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.stikers.stikers-list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.stikers.stiker-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSticker $request)
    {
        try{
            $validatedData = $request->validated();
            $icons=array();
            foreach($request->icons as  $file){

                $name = Str::uuid().'.'.$file->getClientOriginalExtension();
                $path = $file->storeAs('uploads/icons' , $name);
                $size= $file->getSize();
                $extension= $file->getClientOriginalExtension();
                $type= $file->getMimeType();

                $fileAttributes=array('name' => $name, 'path' => $path, 'extension' => $extension,
                 'size' => $size, 'type' => $type);

                 array_push($icons, $fileAttributes);
            }

            $stikers=array();
            foreach($request->stikers as  $file){

                $name = Str::uuid().'.'.$file->getClientOriginalExtension();
                $path = $file->storeAs('uploads/stikers' , $name);
                $size= $file->getSize();
                $extension= $file->getClientOriginalExtension();
                $type= $file->getMimeType();

                $fileAttributes=array('name' => $name, 'path' => $path, 'extension' => $extension,
                 'size' => $size, 'type' => $type);

                 array_push($stikers, $fileAttributes);
            }


            $stiker = new Stiker();
            $stiker->category = $validatedData['category'];
            $stiker->title = $validatedData['title'];
            $stiker->icons =  json_encode($icons);
            $stiker->stikers =  json_encode($stikers);
            $stiker->tags = $validatedData['tags'];
            // $stiker->premium = $validatedData['premium'];
            $stiker->premium = $validatedData['premium'];


            $stiker->status = '1';
            $stiker->created_by = Auth::id();

                if($stiker->save()){
                    return response()->json(['status'=>'200' , 'message' => 'stiker created successfully.'] , 200);

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
        $singleRecord  =  Stiker::where('id',$id)->with('pack')->get();
        // dd(json_decode($singleRecord[0]->icons));
        JavaScript::put([
            'id' => $id,
            'icons' => json_decode( $singleRecord[0]->icons ),
            'stikers' => json_decode( $singleRecord[0]->stikers )
        ]);
        return \View::make('admin.stikers.stiker-edit' , compact('singleRecord'));
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
        return \response()->json(Stiker::with('pack')->get(), 200);

    }
    public function deleteImage(Request $request)
    {
        $detail = Stiker::find($request->id);
        if($request->fileType === 'icon'){
            $decodedArray = json_decode($detail->icons);
            $array = array();
            foreach ($decodedArray as $key => $value) {
                if ($value->name !== $request->name) {
                    array_push($array, $value);
                }
            }
            $detail->icons = json_encode( $array );
            File::delete("storage/$request->path");
            if($detail->save()){
                return response()->json("image successfully.");
            }
        }
        else if($request->fileType === 'sticker'){
            $decodedArray = json_decode($detail->stikers);
            $array = array();
            foreach ($decodedArray as $key => $value) {
                if ($value->name !== $request->name) {
                    array_push($array, $value);
                }
            }
            $detail->stikers = json_encode( $array );
            File::delete("storage/$request->path");
            if($detail->save()){
                return response()->json("image successfully.");
            }
        } 

    }
}
