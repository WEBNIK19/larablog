<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BlockUser;
use Validator;

class BlockUserController extends Controller
{
    //
	public function getAllBlocks(Request $request){
		$data = BlockUser::all();
		
		return response()->json($data);
	}

	public function getBlock(Request $request){
		$valdator = Validator::make($request->all(),[
			'block_id' => 'required|integer|min:1|exists:block_users,id',
		]);

		if($validator->fails()){
			$data = [
				'status' => 0,
				'errors' => $validator->errors(),
			];
		}else{
			$block = BlockUser::find($request->input('block_id'));

			$data = [
				'status' => 0,
				'errors' => $block,
			];
		}
		return response()->json($data);
	}

	public function setBlock(Request $request){
		$valdator = Validator::make($request->all(),[
			'user_id' => 'required|integer|min:1|exists:users,id',
			'creater_id' => 'required|integer|min:1|exists:users,id',
		]);

		if($validator->fails()){
			$data = [
				'status' => 0,
				'errors' => $validator->errors(),
			];
		}else{
			$block = new BlockUser();
			$block->creater_id = $request->input('creater_id');
			$block->creater_id = $request->input('user_id');
			$block->save();

			$data = [
				'status' => 1,
			];

		}

		return response()->json($data);
	}


	public function deleteBlock(Request $request){
		$valdator = Validator::make($request->all(),[
			'block_id' => 'required|integer|min:1|exists:block_users,id',
		]);

		if($validator->fails()){
			$data = [
				'status' => 0,
				'errors' => $validator->errors(),
			];
		}else{
			BlockUser::destroy($request->input('block_id'));
			$data = [
				'status' => 1,
			];
		}

		return response()->json($data);
	}
}
