<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;
use Auth;
use App\Http\Controllers\Controller;
use App\User;
use App\TypeUser;
use App\Classes\Constants;

class UserController extends Controller
{
	 use SoftDeletes;

	 protected $dates = ['deleted_at'];
   
	public function getUser(Request $request)
	{
		$validator = Validator::make($request->all(),[
			'user_id'=>'required|exists:users,id'
		]);

		if($validator->fails()){
			$data = [
				'status' => 0,
				'errors' => $validator->errors(),
			];
		} else {
			$id = $request->query('user_id');
			$user = User::find($id);
			$data = [
				'status' => 1,
				'user'   => $user,
			];
		}

		return response()->json($data);
	}

	public function getAllUsers()
	{
		$data = User::all();

		return response()->json($data);
	}

	public function setUser(Request $request)
	{
		$validator = Validator::make($request->all(),[
			'name' => 'required|string|unique:users,name',
			'email' => 'required|string|email|unique:users,email',
			'password' => 'required|confirmed',
			'password_confirmation' => 'required',
			'type_user_id' => 'required|integer|min:1',
		]);

		if($validator->fails()){
			$data = [
				'status' => 0,
				'errors' => $validator->errors(),
			];
		}else{
			$exist_type = TypeUser::find($request->input('type_user_id'));
			if(is_null($exist_type)){
				$data = [
					'status' => 0,
					'errors' => 'Type not exist!',
				];
			} else {
				$user = new User();
				$user->name = $request->input('name');
				$user->email = $request->input('email');
				$user->password = bcrypt($request->input('password'));
				$user->api_token = str_random(60);
				$user->type_user_id = $request->input('type_user_id');
				$user->save();
				$data = [
					'status' => 1,
				];
			}			
		}
		
		return response()->json($data);

	}

	public function deleteUser(Request $request)
	{
		$validator = Validator::make($request->all(),[
			'user_id' => 'required|exists:users,id|integer|min:1',
		]);

		if($validator->fails()){

			$data = [
				'status' => 0,
				'errors' => $validator->errors(),
			];

		} else {
			
				User::destroy($request->input('user_id'));
				$data = [
					'status' => 1,
				];
			
		}

			return response()->json($data);		
	}

	public function putUser(Request $request)
	{
		$validator = Validator::make($request->all(),[
			'user_id' => 'required|exists:users,id|integer|min:1',
			'type_user_id' => 'exists:type_users,id',
		]);

		if($validator->fails()){
			$data = [
				'status' => 0,
				'errors' => $validator->errors(),
			];

		} else {

			$user = User::find($request->input('user_id'));

			$password = $request->input('password');
			$password_confirmation = $request->input('password_confirmation');

			if(!empty($request->input('type_user_id'))){
				$user->type_user_id = $type_user_id;
			} 

			if(!empty($request->input('name'))){
				$user->name = $request->input('name');
			}

			if(!empty($request->input('email'))){
				$validator = Validator::make([
					'email' => "unique:users",
				]);
				if($validator->fails()){
					$data = [
						'status' => 0,
						'errors' => $validator->errors(),
					];
					return response()->json($data);
				} else {
					$user->email = $rquest->input('email');
				}
			}

			if(!empty($password)&&!empty($password)){
				if($password == $password_confirmation){
					$user->password = bcrypt($request->input('password'));
				} else {
					$data = [
						'status' => 0,
						'errors' => 'Passwords don`t match!',
					];
				}				
			}
			
			$user->save();

			$data=[
				'status' => 1,
			];

		}

		return response()->json($data);
	}

	public function getUserCurrent(Request $request)
	{
		$data = [
			'status' => 1,
			'user'=> Auth::user(),
		];

		return response()->json($data);
	}
}
