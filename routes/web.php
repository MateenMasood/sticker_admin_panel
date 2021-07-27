<?php

use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

// //********************* Research ******************// datatable
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'admin\HomeController@index');

    // ======================== sticker project routes ============================
    Route::get('/pack/datatable' , 'admin\pack\PackController@datatable'); 
    Route::resource('/pack' , 'admin\pack\PackController');
    
    Route::get('/label/datatable' , 'admin\labels\LabelController@datatable'); 
    Route::resource('/label' , 'admin\labels\LabelController');
    
    Route::get('/support/datatable' , 'admin\support\SupportController@datatable'); 
    Route::resource('/support' , 'admin\support\SupportController');

    Route::get('/keyword/datatable' , 'admin\keywords\KeywordController@datatable'); 
    Route::resource('/keyword' , 'admin\keywords\KeywordController');
    
    Route::get('/contact/datatable' , 'admin\contact\ContactController@datatable'); 
    Route::resource('/contact' , 'admin\contact\ContactController');
    
    Route::get('/notification/datatable' , 'admin\notifications\NotificationController@datatable'); 
    Route::resource('/notification' , 'admin\notifications\NotificationController');
    
    Route::get('/app-user/datatable' , 'admin\appUser\AppUserController@datatable'); 
    Route::resource('/app-user' , 'admin\appUser\AppUserController');
    
    Route::get('/app-user-log/datatable' , 'admin\appUser\AppUserLogController@datatable'); 
    Route::resource('/app-user-log' , 'admin\appUser\AppUserLogController');

    Route::get('/slides/datatable' , 'admin\slides\SlideController@datatable');
    Route::resource('/slides' , 'admin\slides\SlideController');

    Route::resource('/stikers' , 'admin\stikers\StikerController');
    Route::resource('/site/settings' , 'admin\settings\SiteSettingController');


	Route::post('/hotel/change-status' , 'admin\hotel\HotelController@ChangeStatus');
	Route::get('/hotel/select2' , 'admin\hotel\HotelController@select2');
    Route::get('/hotel/datatable' , 'admin\hotel\HotelController@datatable');
    Route::resource('/hotel' , 'admin\hotel\HotelController')->name('*' , 'hotel');

	Route::get('/rooms-type/select2' , 'admin\rooms\roomsType\RoomTypeController@select2');
	Route::post('/rooms-type/rooms-type-file-delete' , 'admin\rooms\roomsType\RoomTypeController@roomTypeFileDelete');
	Route::get('/rooms-type/datatable' , 'admin\rooms\roomsType\RoomTypeController@datatable');
	Route::resource('/rooms-type' , 'admin\rooms\roomsType\RoomTypeController')->name('*' , 'roomsType');

	Route::get('/rooms/datatable' , 'admin\rooms\rooms\RoomController@datatable');
    Route::resource('/rooms' , 'admin\rooms\rooms\RoomController');

    // ******************* policy ************

    Route::get('/policy/datatable' , 'admin\settings\policy\PolicyController@datatable');
    Route::resource('/policy' , 'admin\settings\policy\PolicyController');


    // ************************ slider **************************************

    Route::get('/slider/datatable' , 'admin\settings\slider\SliderController@datatable');
    Route::resource('/slider' , 'admin\settings\slider\SliderController');

    // ********************************* promocode *******************************

    Route::post('/promo-code/change-status' , 'admin\promocode\PromoCodeController@ChangeStatus');
    Route::get('/promo-code/datatable' , 'admin\promocode\PromoCodeController@datatable');
    Route::resource('/promo-code' , 'admin\promocode\PromoCodeController');

    // ************************ rbac ***********************

    Route::post('/rbac/users/change-status' , 'admin\settings\rbac\EmployeeController@ChangeStatus');
    Route::get('/rbac/users/datatable' , 'admin\settings\rbac\EmployeeController@datatable');
    Route::resource('/rbac/users' , 'admin\settings\rbac\EmployeeController');


    Route::post('/rbac/roles/role-permission' , 'admin\settings\rbac\RoleController@assignPermissionToRole');
    Route::get('/rbac/roles/select2' , 'admin\settings\rbac\RoleController@select2');
    Route::get('/rbac/roles/datatable' , 'admin\settings\rbac\RoleController@datatable');
    Route::post('/rbac/roles/change-status' , 'admin\settings\rbac\RoleController@ChangeStatus');
    Route::resource('/rbac/roles' , 'admin\settings\rbac\RoleController');

    Route::post('/rbac/permissions/change-status' , 'admin\settings\rbac\PermissionController@ChangeStatus');
    Route::get('/rbac/permissions/datatable' , 'admin\settings\rbac\PermissionController@datatable');
    Route::resource('/rbac/permissions' , 'admin\settings\rbac\PermissionController');


    Route::post('/near-by-places/change-status', 'admin\settings\nearByPlaces\NearByPlaceController@ChangeStatus');
    Route::get('/near-by-places/datatable', 'admin\settings\nearByPlaces\NearByPlaceController@datatable');
    Route::resource('/near-by-places', 'admin\settings\nearByPlaces\NearByPlaceController');


    Route::post('/resort-facility/change-status', 'admin\settings\ResortFacilities\ResortFacilityController@ChangeStatus');
    Route::get('/resort-facility/datatable', 'admin\settings\ResortFacilities\ResortFacilityController@datatable');
    Route::resource('/resort-facility', 'admin\settings\ResortFacilities\ResortFacilityController');
});

// Route::get('pages-login', 'VeltrixController@index');
// Route::get('pages-login-2', 'VeltrixController@index');
// Route::get('pages-register', 'VeltrixController@index');
// Route::get('pages-register-2', 'VeltrixController@index');
// Route::get('pages-recoverpw', 'VeltrixController@index');
// Route::get('pages-recoverpw-2', 'VeltrixController@index');
// Route::get('pages-lock-screen', 'VeltrixController@index');
// Route::get('pages-lock-screen-2', 'VeltrixController@index');
// Route::get('pages-404', 'VeltrixController@index');
// Route::get('pages-500', 'VeltrixController@index');
// Route::get('pages-maintenance', 'VeltrixController@index');
// Route::get('pages-comingsoon', 'VeltrixController@index');


// Route::get('{any}', 'HomeController@index');

// Route::get('index/{locale}', 'LocaleController@lang');
