<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\Comment;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


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
			return back()->withErrors();
        }

		//Verifies if the post exists
        $post = Post::findOrFail($request->input('post_id'));

		//Verifies if the post is archived
		if($post->isArchived()) {
			return back()->withErrors(array('message' => 'A postagem já foi arquivada!'));
		}

		$comment_decoded = $request->comment;

		$comment = Comment::create([
			'post_id' => $request->post_id,
			'user_id' => Auth::id(),
			'comment' => $comment_decoded
		]);        
             
		return redirect(route('post.show', $request->post_id));
        
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