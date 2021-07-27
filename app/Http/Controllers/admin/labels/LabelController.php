<?php

namespace App\Http\Controllers\admin\labels;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Label;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \View::make('admin.labels.labels-list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \View::make('admin.labels.label-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'status' => 'required|numeric',
            'file.*' => 'required',
        ]);
        $labelModel = new NearByPlace();

        $file = $validatedData['file'][0];
        $imageName = Str::uuid().'.'.$file->getClientOriginalExtension();
        $imagePath = $file->storeAs('uploads/labels' , $imageName);
        
        $labelModel->identifier = '283746msdfjsdhf2834SDFS';
        $labelModel->path = $imagePath;
        $labelModel->file_name = $imageName;
        $labelModel->size = $file->getSize();
        $labelModel->mime_type = $file->getMimeType();
        $labelModel->extension = $file->getClientOriginalExtension();
        $labelModel->zone = $imageZone;
        $labelModel->status = '1';
        $labelModel->label_status = $validatedData['status'] === 'on' ? 1 : 0;
        $labelModel->created_by = Auth::id();
        // $imagePath = $file->storeAs('uploads/nearByPlacesImages' , $imageName);

        // Hash::make(time()+substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit))
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
}
