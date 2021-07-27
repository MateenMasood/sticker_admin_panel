<?php

namespace App\Http\Controllers\admin\notifications;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Http\Requests\StoreNotification;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \View::make('admin.notifications.notifications-list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \View::make('admin.notifications.notification-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNotification $request)
    {
        $validatedData = $request->validated();
        $notificationModel = new Notification();
        $notificationModel->title = $validatedData['title'];
        $notificationModel->content = '{"id":"165236fe-07a4-4c08-be4e-617cb2f65ba4","recipients":14772,"external_id":null}';
        $notificationModel->status = '1';
        $notificationModel->created_by = Auth::id();

        if($notificationModel->save()){
            return response()->json(['status'=>'200' , 'message' => 'notification created successfully.'] , 200);

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
        $deleteRecord =  Notification::find($id);

        if($deleteRecord->delete()){
            return response()->json('Your Record has been deleted.' , 200);

        }else{
            return response()->json(  'error occured please try again' , 200);

        }
    }

    /* datatable */

    public function datatable()
    {
        return \response()->json(Notification::all() , 200);
    }
}
