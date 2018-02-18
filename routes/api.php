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


Route::post("/login", "Api\UserController@login");
Route::post("/register", "Api\UserController@register");
Route::post("/password/email", "Api\UserController@sendResetLinkEmail");
Route::post("/reset/password", "Api\UserController@resetEmail");


Route::group(['middleware'=>'auth:api'], function () {

			Route::get("/user/all","Api\UserController@getAllUsers");
			Route::get("/user/current","Api\UserController@getUserCurrent");
			Route::get("/user","Api\UserController@getUser");
			
			Route::get("/post/all","Api\PostController@getAllPosts");
			Route::get("/post","Api\PostController@getPost");
			Route::post("/post","Api\PostController@setPost");
			Route::put("/post","Api\PostController@putPost");
			Route::delete("/post","Api\PostController@deletePost");
			
		Route::group(['middleware'=>'admin'], function(){
			Route::post("/user","Api\UserController@setUser");
			Route::put("/user","Api\UserController@putUser");
			Route::delete("/user","Api\UserController@deleteUser");

			Route::get("/type/all","Api\TypeUserController@getAllTypes");
			Route::get("/type","Api\TypeUserController@getType");
			Route::post("/type","Api\TypeUserController@setType");
			Route::put("/type","Api\TypeUserController@putType");
			Route::delete("/type","Api\TypeUserController@deleteType");

			Route::get("/block/all","Api\TypeUserController@getAllBlocks");
			Route::get("/block","Api\TypeUserController@getBlock");
			Route::post("/block","Api\TypeUserController@setBlock");
			Route::delete("/block","Api\TypeUserController@deleteBlock"); 
		});
				
});

		