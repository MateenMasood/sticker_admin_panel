<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('api')->resource('/pack', 'admin\api\PackController');
Route::middleware('api')->resource('/label', 'admin\api\LabelController');
Route::middleware('api')->resource('/sticker', 'admin\api\StickerController');
Route::middleware('api')->resource('/setting', 'admin\api\SettingController');
Route::middleware('api')->post('/sticker_by_tag', 'admin\api\StickerController@StickerByTag');
