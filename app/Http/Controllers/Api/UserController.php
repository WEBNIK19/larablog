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

		return view('data',['data'=>$data]);

	}
	public function getAllUsers()
	{

	}

	public function setUser($id=null)
	{

	}

	public function deleteUser($id=null)
	{

	}

	public function putUser($id=null)
	{

	}

	public function getUserCurrent()
	{
		
	}
}
