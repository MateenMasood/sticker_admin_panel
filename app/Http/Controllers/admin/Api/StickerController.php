<?php

namespace App\Http\Controllers\admin\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stiker;
use Illuminate\Support\Facades\Validator;


class StickerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Stiker::orderBy('id')->paginate(10);
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
        $validatedData = $request->validate([
            'category_id' => 'required',
        ]);
        $list = Stiker::Where('category', $validatedData['category_id'] ) ->orderBy('id')->get();
        return \response()->json($list , 200);
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

    public function StickerByTag(Request $request)
    {
        $validatedData = Validator::make($request->all() , [
            'tag' => 'required',
        ]);
        if ($validatedData->fails()) {
            return response()->json("please enter tag", 200);
        }

        // $list = Stiker::where("title","LIKE" , "%$request->tag%")->get();
        $list = Stiker::whereRaw('FIND_IN_SET("$")', $request->tag)->get();
        return response()->json($list, 200,);
    }
}
