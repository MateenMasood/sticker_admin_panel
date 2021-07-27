<?php

namespace App\Http\Controllers\admin\settings\slider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\Slider;
use App\Models\Sliderimage;
use Illuminate\Support\Facades\Auth;
use JavaScript;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\DB;


class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \View::make('admin.settings.slider.sliders-list');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \View::make('admin.settings.slider.slider-create');

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

                // ********** start transction ************
        DB::beginTransaction();

        try {

            $sliderModel = new Slider();

            $sliderModel->slider_id = IdGenerator::generate(['table' => 'sliders', 'length' => 13, 'field' => 'slider_id', 'prefix' => 'SI-']);
            $sliderModel->title = 'slider';
            $sliderModel->status = '1';
            $sliderModel->created_by = Auth::id();


            $sliderModel->save();



        foreach($request->file as $key=> $file){

            $imageZone = '';
            if($key == '0'){
                $imageZone = 'baseImage';
            }else{
                $imageZone = 'optionalImage';
            }
            $imageName = Str::uuid().'.'.$file->getClientOriginalExtension();
            $imagePath = $file->storeAs('uploads/sliderImages' , $imageName);



            $sliderImageModel = new SliderImage();
            $sliderImageModel->slider_id = $sliderModel->id;
            $sliderImageModel->slider_image_id = IdGenerator::generate(['table' => 'slider_images', 'length' => 13, 'field' => 'slider_image_id', 'prefix' => 'SI-']);
            $sliderImageModel->path = $imagePath;
            $sliderImageModel->file_name = $imageName;
            $sliderImageModel->size = $file->getSize();
            $sliderImageModel->mime_type = $file->getMimeType();
            $sliderImageModel->extension = $file->getClientOriginalExtension();
            $sliderImageModel->zone = $imageZone;
            $sliderImageModel->status = '1';
            $sliderImageModel->created_by = Auth::id();


            $sliderImageModel->save();
        }
            DB::commit();

            return response()->json("slider has been added successfully.");
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
        $deleteRecord =  Slider::find($id);

        if($deleteRecord->delete()){
            return response()->json('Your Record has been deleted.' , 200);

        }else{
            return response()->json('error occured please try again' , 200);

        }
    }

    // ******************************* dataatable *********************

    public function datatable()
    {
        return \response()->json(Slider::all() , 200);

    }
}
