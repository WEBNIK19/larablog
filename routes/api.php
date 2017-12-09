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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group(['middleware'=>'auth:api'], function () {
	
		Route::get("/user/current","Api\UserController@getCurrentUser");

		Route::get("/user","Api\UserController@getUser");

		Route::get("/user/all","Api\UserController@getAllUsers");
		
		Route::post("/user","Api\UserController@setUser");
		Route::put("/user/{user_id}","Api\UserController@putUser");
		Route::delete("/user/{user_id}","Api\UserController@deleteUser");

		Route::get("/type/user/all","Api\TypeUserController@getAllTypes");
		Route::get("/type/user","Api\TypeUserController@getType");
		Route::post("/type/user","Api\TypeUserController@setType");
		Route::put("/type/user","Api\TypeUserController@putType");
		Route::delete("/type/user","Api\TypeUserController@deleteType");

		Route::get("/block/user/all","Api\TypeUserController@getAllBlocks");
		Route::get("/block/user","Api\TypeUserController@getBlock");
		Route::post("/block/user","Api\TypeUserController@setBlock");
		Route::put("/block/user","Api\TypeUserController@putBlock");
		Route::delete("/block/user","Api\TypeUserController@deleteBlock");
});
