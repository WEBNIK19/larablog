<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use Validator;

class PostController extends Controller
{
    public function getAllPosts(){
    	$data = [
    		'status' => 1,
    		'data' => Post::all(),
    	]

    	return response()->json($data);
    }

    public function getPost(Request $request){
    	$validator = Validator::make($request->all(),[
    		'post_id' => 'required|exists:posts,id',
    	]);

    	if($validator->fails()){
    		$data = [
    			'status' => 0,
    			'errors' => $validator->errors(),
    		];
    	} else {
    		$id = $request->input('post_id');

    		$data = [
    				'status' => 1,
    				'data' => Post::find($id),
    		];
    	}

    	return request()->json($data);
    }

    public function setPost(Request $request){
    	$validator = Validator::make($request->all(),[
    			'user_id' => 'required|exists:users,id',
    			'header' => 'required|string|min:1',
    			'post' => 'required|string|min:1',
    			'allow_comments' => 'required|boolean',
    	]);

    	if($validator->fails()){
    		$data = [
    			'status' => 0,
    			'data' => $validator->$errors(),
     		];
    	} else {
    		$post = new Post();
    		$post->user_id = $request->input('user_id');
    		$post->header = $request->input('header');
    		$post->post = $request->input('post');
    		$post->allow_comments = $request->input('allow_comments');
    		$post->save();
    		$data = [
    			'status' => 1,
    		];
    	}

    	return response()->json($data);
    }
}
