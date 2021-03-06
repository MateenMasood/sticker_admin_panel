<?php

namespace App\Http\Controllers\admin\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        $list = Pack::with('stickers' )->orderBy('id')->get();
        foreach ($list as $key => $value) {
            foreach ($value->stickers as $key => $stickerValue) {
               if (isset($stickerValue->icons) ) {
                   $icons = json_decode( $stickerValue->icons );
                   $iconsArray = []; 
                    foreach ($icons as $key => $Image) {
                        $iconsArray[$key]['images'] = $Image->name;
                    } 
                   $stickerValue['tray_icon'] = $iconsArray;
                }
                if (isset($stickerValue->stikers) ) {
                    $stikers = json_decode( $stickerValue->stikers );
                    $stkArray = []; 
                    foreach ($stikers as $key => $Image) {
                        $stkArray[$key]['images'] = $Image->name;
                    } 
                    $stickerValue['sticker_files'] = $stkArray;
                 }
               
            }
            
        }
        return \response()->json($list , 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
