<?php

namespace App\Http\Controllers\admin\promoCode;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\Coupon;
use Illuminate\Support\Facades\Auth;
use JavaScript;
use App\Http\Requests\StoreCoupon;
use App\Http\Requests\UpdateCoupon;

class PromoCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \View::make('admin.promoCode.promo-codes-list');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \View::make('admin.promoCode.promo-code-create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCoupon $request)
    {


        $validatedData = $request->validated();

        $couponModel = new Coupon();
        $couponModel->coupon_id = IdGenerator::generate(['table' => 'coupons', 'length' => 13, 'field' => 'coupon_id', 'prefix' => 'CPN-']);
        $couponModel->name = $request->name;
        $couponModel->code = $validatedData['code'];
        $couponModel->discount_type = $validatedData['discountType'];
        $couponModel->value = $validatedData['Value'];
        $couponModel->start_date = $validatedData['startDate'];
        $couponModel->end_date = $validatedData['endDate'];
        $couponModel->per_coupon_usage_limit = $validatedData['perCouponUsageLimit'];
        $couponModel->usage_limit_per_person = $validatedData['usageLimitPerPerson'];
        $couponModel->status = ($request->has('enableCoupon') ? '1' : '0');
        $couponModel->created_by = Auth::id();

        if($couponModel->save()){
            return response()->json(['status'=>'true' , 'message' => 'coupon created successfully.'] , 200);

        }else{
            return response()->json(['status'=>'true' , 'message' => 'Error! Please try again.'] , 200);

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
        JavaScript::put([
            'id' => $id,
        ]);
        $singlRecord  =  Coupon::find($id);
        return \View::make('admin.promoCode.promo-code-edit' , compact('singlRecord'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCoupon $request, $id)
    {

        $validatedData = $request->validated();

        $couponModel = Coupon::find($id);
        $couponModel->name = $request->name;
        $couponModel->code = $validatedData['code'];
        $couponModel->discount_type = $validatedData['discountType'];
        $couponModel->value = $validatedData['Value'];
        $couponModel->start_date = $validatedData['startDate'];
        $couponModel->end_date = $validatedData['endDate'];
        $couponModel->per_coupon_usage_limit = $validatedData['perCouponUsageLimit'];
        $couponModel->usage_limit_per_person = $validatedData['usageLimitPerPerson'];
        $couponModel->status = ($request->has('enableCoupon') ? '1' : '0');
        $couponModel->created_by = Auth::id();

        if($couponModel->save()){
            return response()->json(['status'=>'true' , 'message' => 'coupon updated successfully.'] , 200);

        }else{
            return response()->json(['status'=>'true' , 'message' => 'Error! Please try again.'] , 200);

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
        $deleteRecord =  Coupon::find($id);

        if($deleteRecord->delete()){
            return response()->json('Your Record has been deleted.' , 200);

        }else{
            return response()->json(  'error occured please try again' , 200);

        }
    }

    // *************************** datatbale ***************************

    public function datatable()
    {
        return \response()->json(Coupon::all() , 200);

    }

    // ********************** change status **********************

    public function ChangeStatus(Request $request)
    {
        $changeStatus =  Coupon::find($request->id);
        $changeStatus->status = ( ($request->status == '0') ? '0' : '1');

        if($changeStatus->save()){
            return response()->json('You change the status of coupon code successfully.' , 200);

        }else{
            return response()->json(  'error occured please try again' , 200);

        }

    }
}
