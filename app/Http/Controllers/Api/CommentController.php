<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function getPostsComments() {
    	$validator = Validator::make($request->all(),[
    		'post_id' => 'requred|exists:posts,id'
    	]);
    	if($validator->fails()) {
    		$data = [
    			'status' => 0,
    			'errors' => $validator->errors(),
    		];
    	} else {
    		$comments = Comment::where('post_id',$request->input('post_id'))->get();
    		$data = [
    			'status' => 1,
    			'data' => $comments,
    		];
    	}

    	return response()->json($data);
    }

    public function getUsersComments() {
    	$validator = Validator::($request->all(),[
    		'user_id' => 'required|exists:users,id',
    	]);

    	if($validator->fails()) {
    		$data = [
    			'status' => 0,
    			'errors' => $validator->errors(),
    		];
    	} else {
    		$comments = Comment::where('user_id',$request->input('user_id'))->get();
    		$data = [
    			'status' => 1,
    			'data' => $comments,
    		];
    	}

    	return response()->json($data);
    }

    public function getComment(Request $request){
    	$validator = Validator::($request->all(),[
    		'comment_id' => 'required|exists:comments,id',
    	]);

    	if($validator->fails()) {
    		$data = [
    			'status' => 0,
    			'errors' => $validator->errors(),
    		];
    	}	else {
    		$comment = Comment::find($request->input('comment_id'));
    		$data = [
    			'status' => 1,
    			'data' => $comment,
    		];
    	}

    	return response()->json($data);
    } 
}
