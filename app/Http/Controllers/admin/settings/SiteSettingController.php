<?php

namespace App\Http\Controllers\admin\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Setting;
use Illuminate\Support\Str;
use Exception;



class SiteSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.settings.site-setting.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{

        Setting::set('app_name', $request->app_name);
        Setting::set('admob_banner_id', $request->admob_banner_id);
        Setting::set('admob_interstitial_id', $request->admob_interstitial_id);
        Setting::set('admob_rewarded_id', $request->admob_rewarded_id);
        Setting::set('admob_status', $request->admob_status);
        Setting::set('app_version', $request->app_version);
        Setting::set('app_message', $request->app_message);
        Setting::set('app_purchase_code', $request->app_purchase_code);
        Setting::set('product_id', $request->product_id);
        Setting::set('server_key', $request->server_key);
        Setting::set('is_maintance', $request->is_maintance);




        Setting::set('site_slider_title', $request->site_slider_title);
        Setting::set('site_slider_desc', $request->site_slider_desc);
        Setting::set('site_slider_button_link', $request->site_slider_button_link);
        Setting::set('site_slider_background_color', $request->site_slider_background_color);

        $slideImages=array();
            foreach($request->site_slider_images as  $file){

                $name = Str::uuid().'.'.$file->getClientOriginalExtension();
                $path = $file->storeAs('uploads/slider_images' , $name);
                $size= $file->getSize();
                $extension= $file->getClientOriginalExtension();
                $type= $file->getMimeType();

                $fileAttributes=array('name' => $name, 'path' => $path, 'extension' => $extension,
                 'size' => $size, 'type' => $type);

                 array_push($slideImages, $fileAttributes);
            }
        Setting::set('site_slider_images', json_encode($slideImages));


        Setting::set('site_service_title', $request->site_service_title);
        Setting::set('site_service_description', $request->site_service_description);
        Setting::set('site_service_first_title', $request->site_service_first_title);
        Setting::set('site_service_first_icon', $request->site_service_first_icon);
        Setting::set('site_service_first_description', $request->site_service_first_description);
        Setting::set('site_service_second_title', $request->site_service_second_title);
        Setting::set('site_service_second_icon', $request->site_service_second_icon);
        Setting::set('site_service_second_description', $request->site_service_second_description);
        Setting::set('site_service_third_title', $request->site_service_third_title);
        Setting::set('site_service_third_icon', $request->site_service_third_icon);
        Setting::set('site_service_third_description', $request->site_service_third_description);
        Setting::set('site_service_fourth_title', $request->site_service_fourth_title);
        Setting::set('site_service_fourth_icon', $request->site_service_fourth_icon);
        Setting::set('site_service_fourth_description', $request->site_service_fourth_description);


        Setting::set('og_type', $request->og_type);
        Setting::set('og_url', $request->og_url);
        Setting::set('og_site_name', $request->og_site_name);
        Setting::set('og_title', $request->og_title);

        $file = $request->og_image;
        $name = Str::uuid().'.'.$file->getClientOriginalExtension();
        $path = $file->storeAs('uploads/og_images' , $name);
        $size= $file->getSize();
        $extension= $file->getClientOriginalExtension();
        $type= $file->getMimeType();

        $fileAttributes=array('name' => $name, 'path' => $path, 'extension' => $extension,
            'size' => $size, 'type' => $type);
        Setting::set('og_image', json_encode($fileAttributes));


        Setting::set('site_team_section_title', $request->site_team_section_title);
        Setting::set('site_team_section_short_description', $request->site_team_section_short_description);
        Setting::set('site_team_section_description', $request->site_team_section_description);



        Setting::set('portfolio_section_title', $request->portfolio_section_title);
        Setting::set('portfolio_section_description', $request->portfolio_section_description);
        Setting::set('portfolio_section_count_limit', $request->portfolio_section_count_limit);


        Setting::set('facebook', $request->facebook);
        Setting::set('twitter', $request->twitter);
        Setting::set('linkedin', $request->linkedin);
        Setting::set('terms_of_usage', $request->terms_of_usage);
        Setting::set('privacy_policy', $request->privacy_policy);


        Setting::save();

        return response()->json(['status'=>'200' , 'message' => 'setting saved successfully.'] , 200);

        }catch (Exception $e) {

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
}
