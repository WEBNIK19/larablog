<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    //
	public function __construct()
	{
		
	}

	public function getUser(Request $request)
	{
		$id = $request->query('user_id');

    $data = User::find($id);
		return response()->json($data);
	}
	public function getAllUsers()
	{
		$data = User::all();
		return response()->json($data);
	}

	public function setUser(Request $request)
	{

	}

	public function deleteUser(Request $request)
	{

	}

	public function putUser(Request $request)
	{

	}

	public function getUserCurrent(Request $request)
	{
		
	}
}
