<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comment;

class CommentController extends Controller
{
    public function getAllComments() {
      
            $data = [
                'status' => 1,
                'data' => Comment::latest()->get(),
            ];

        return response()->json($data);
    }
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
    	$validator = Validator::make($request->all(),[
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
    	$validator = Validator::make($request->all(),[
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

    public function putComment(Request $request) {
        $validator = Validator::make($request->all(),[
            'comment_id' => 'required|exists:comments,id',
            'comment' => 'string|min:1',
        ]);

        if($validator->fails()) {
           $data = [
                'status' => 0,
                'errors' => $validator->errors(),
           ]; 
        } else {
            $comment = Comment::find($request->input('comment_id'));

            if(!empty($request->input('comment'))) {
               $comment->comment = $request->input('comment');
            }
             
             $data = [
                'status' => 1,
             ];
        }

        return response()->json($data);
    }

    public function setComment(Request $request) {
        $validator = Validator::make($request->all(),[
            'user_id' => 'required|exists:users,id',
            'comment' => 'required|string|min:1',
            'post_id' => 'required|exists:posts,id',
        ]);

        if($validator->fails()) {
            $data = [
                'status' => 0,
                'errors' => $validator->errors(),
            ];
        } else {
            $comment = new Comment();
            $comment->user_id = $request->input('user_id');
            $comment->post_id = $request->input('post_id'); 
            $comment->comment = $request->input('comment'); 
            $comment->read = false;

            $data = [
                'status' => 1,
            ];  
        }

        return response()->json($data);
    }

    public function deleteComment(Request $request) {
        $validator = Validator::make($request->all(),[
            'comment_id' => 'required|exists:comments,id'
        ]);
        if($validator->fails()) {
            $data = [
                'status' => 0,
                'errors' => $validator->errors(),
            ];
        } else {
            Comment::destroy($request->input('comment_id'));
            $data = [
                'status' => 1,
            ];
        }

        return response()->json($data);
    }
}
