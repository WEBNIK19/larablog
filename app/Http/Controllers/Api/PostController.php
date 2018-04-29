<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comment;
use App\Post;
use Validator;
use Auth;

class PostController extends Controller
{
    public function getAllPosts(Request $request) {
        $validator = Validator::make($request->all(),[
            'page' => 'required|integer|min:1',
            'per_page' => 'required|integer|min:1',
        ]);
        if($validator->fails()){
            $data = [
                'status' => 0,
                'errors' => $validator->errors(),
            ];
        } else {
            $count = Post::count();
            $page = (int)($request->input('page'));
            $per_page = (int)($request->input('per_page'));
            $totally = ceil($count/$per_page);

            if($per_page*($page-1) + $per_page - 1 > $count){
                $first = ($count - $per_page);
            } else {
                $first = $per_page*($page-1);
            }
            $posts = Post::pgnt($first, $per_page);
            
            $data = [
                'status' => 1,
                'data' => ['totally'=> $totally, 
                            'posts' => $posts],
            ];

        }
    	
    	return response()->json($data);
    }
    
    public function getTodayPosts(Request $request) {
        $validator = Validator::make($request->all(),[
            'page' => 'required|integer|min:1',
            'per_page' => 'required|integer|min:1',
        ]);

        if($validator->fails()){
            $data = [
                'status' => 0,
                'errors' => $validator->errors(),
            ];
        } else {
            $count = Post::whereDate('created_at',date('Y-m-d'))->count();
            $page = (int)($request->input('page'));
            $per_page = (int)($request->input('per_page'));
            $totally = ceil($count/$per_page);

            if($per_page*($page-1) + $per_page - 1 > $count){
                $first = ($count - $per_page);
            } else {
                $first = $per_page*($page-1);
            }
            $posts = Post::whereDate('created_at',date('Y-m-d'))->pgnt($first, $per_page);
        	$data = [
        		'status' => 1,
        		'data' => [
                            'totally'=> $totally, 
                            'posts' => $posts
                          ],
        	];
        }
    	return response()->json($data);
    }

    public function getUsersPosts(Request $request) {
    	$validator = Validator::make($request->all(),[
    		'user_id' => 'required|exists:users,id',
            'page' => 'required|integer|min:1',
            'per_page' => 'required|integer|min:1',
    	]);

    	if($validator->fails()) {
    		$data = [
    			'status' => 0,
    			'errors' => $validator->errors(),
    		];
    	} else {
            $count = Post::where('user_id',$request->input('user_id'))->count();
            $page = (int)($request->input('page'));
            $per_page = (int)($request->input('per_page'));
            $totally = ceil($count/$per_page);

            if($per_page*($page-1) + $per_page - 1 > $count){
                $first = ($count - $per_page);
            } else {
                $first = $per_page*($page-1);
            }
    		$posts = Post::where('user_id',$request->input('user_id'))->pgnt($first, $per_page);
    		$data = [
    			'status' => 1,
    			'data' => [
                            'totally'=> $totally, 
                            'posts' => $posts
                          ],
    		];
    	}

    	return response()->json($data);
    }
    
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
    		$id = $request->input('post_id');
    		$post = Post::find($id);
    		$data = [
    				'status' => 1,
    				'data' => $post,
    		];
    	}

    	return response()->json($data);
    }

    public function setPost(Request $request) {
    	$validator = Validator::make($request->all(),[
    			'user_id' => 'required|exists:users,id',
    			'header' => 'required|string|min:1',
    			'post' => 'required|string|min:1',
                'demo' => 'required|string|min:1',
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
            $post->demo = $request->input('demo');
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
    		'post_id' => 'required|exists:posts,id',
    		'header' => 'string|min:1',
            'demo' => 'string|min:1',
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

            if(!empty($request->input('demo'))) {
                $post->demo = $request->input('demo');
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
    		'post_id' => 'required|exists:posts,id',
    	]);

    	if($validator->fails()){
    		$data = [
    			'status' => 0,
    			'errors' => $validator->errors(),
    		];
    	} else {
            Comment::where('post_id',$request->input('post_id'))->delete();
    		Post::destroy($request->input('post_id'));
    		$data = [
    			'status' => 1,
    		];
    	}

    	return response()->json($data);
    }

    public function searchPost(Request $request){
        $validator = Validator::make($request->all(),[
            'page' => 'required|integer|min:1',
            'per_page' => 'required|integer|min:1',
            'word' => 'string|min:1',
        ]);

        if($validator->fails()){
            $data = [
                'status' => 0,
                'errors' => $validator->errors(),
            ];
        } else {
            $search_str = str_replace(" ","%",$request->input('word'));

            $count = Post::where('user_id',$request->input('user_id'))->count();
            $page = (int)($request->input('page'));
            $per_page = (int)($request->input('per_page'));
            $totally = ceil($count/$per_page);

            if($per_page*($page-1) + $per_page - 1 > $count){
                $first = ($count - $per_page);
            } else {
                $first = $per_page*($page-1);
            }

            $results = Post::search($search_str)->pgnt($first,$per_page);
            $data = [
                'status' => 1,
                'data' => $results,
            ];
        }
        return response()->json($data);
    }
}