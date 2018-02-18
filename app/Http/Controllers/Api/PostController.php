<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use Validator;
use Auth;

class PostController extends Controller
{
    public function getAllPosts() {
    	$data = [
    		'status' => 1,
    		'data' => Post::latest()->get(),
    	];

    	return response()->json($data);
    }

    // public function getTodayPosts() {
    // 	$data = [
    // 		'status' => 1,
    // 		'data' => Post::whereDate('created_at',date('Y-m-d'))->get(),
    // 	];

    // 	return response()->json($data);
    // }
    
    public function getPost(Request $request) {
    	$validator = Validator::make($request->all(),[
    		'post_id' => 'required|exists:posts,id',
    	]);

    	if($validator->fails()){
    		$data = [
    			'status' => 0,
    			'errors' => $validator->errors(),
    		];
    	} else {
    		$id = $request->query('post_id');
    		$post = Post::find($id);
    		$data = [
    				'status' => 1,
    				'data' => $post,
    		];
    	}

    	return request()->json($data);
    }

    public function setPost(Request $request) {
    	$validator = Validator::make($request->all(),[
    			'user_id' => 'required|exists:users,id',
    			'header' => 'required|string|min:1',
    			'post' => 'required|string|min:1',
    			'allow_comments' => 'required|boolean',
    	]);

    	if($validator->fails()){
    		$data = [
				'status' => 0,
				'errors' => $validator->errors(),
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

    public function putPost(Request $request){
    	$validator = Validator::make($request->all(),[
    		'post_id' => 'required|exists:post,id',
    		'header' => 'string|min:1',
    			'post' => 'string|min:1',
    			'allow_comments' => 'boolean',
    	]);

    	if($validator->fails()) {
    		$data = [
    			'status' => 0,
    			'errors' => $validator->errors(),
    		];
    	} else {
    		$post = Post::find($request->input('post_id'));

    		if(!empty($request->input('header'))) {
    			$post->header = $request->input('header');
    		}

    		if(!empty($request->input('post'))) {
    			$post->post = $request->input('post');
    		}

    		$post->save();
    		$data = [
    			'status' => 1,
    		];
    	}

    	return response()->json($data);
    }

    public function deletePost(Request $request){
    	$validator = Validator::make($request->all(),[
    		'post_id' => 'required|exists:post,id',
    	]);

    	if($validator->fails()){
    		$data = [
    			'status' => 0,
    			'errors' => $validator->errors(),
    		];
    	} else {
    		Post::destroy($request->input('post_id'));
    		$data = [
    			'status' => 1,
    		];
    	}

    	return request()->json($data);
    }
}