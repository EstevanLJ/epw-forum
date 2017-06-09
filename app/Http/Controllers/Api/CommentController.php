<?php

namespace App\Http\Controllers\Api;

use Validator;
use App\Comment;
use App\Post;
use App\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        //
    }
    
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        //
    }
    
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
			'comment' => 'required',
			'post_id' => 'required'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
            'errors' => $validator->errors(),
            'inputs' => $request->all()
            ], 400);
        }
        
		//Verifica se o post existe
        $post = Post::findOrFail($request->input('post_id'));

		$comment_decoded = base64_decode($request->comment);

		$comment = Comment::create([
			'post_id' => $request->post_id,
			'user_id' => 2,
			'comment' => $comment_decoded
		]);        
        
        return response()->json(['comment' => $comment], 201);       
        
    }
    
    /**
    * Display the specified resource.
    *
    * @param  \App\Comment  $comment
    * @return \Illuminate\Http\Response
    */
    public function show(Comment $comment)
    {
        //
    }
    
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Comment  $comment
    * @return \Illuminate\Http\Response
    */
    public function edit(Comment $comment)
    {
        //
    }
    
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Comment  $comment
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Comment $comment)
    {
        //
    }
    
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Comment  $comment
    * @return \Illuminate\Http\Response
    */
    public function destroy(Comment $comment)
    {
        //
    }
}