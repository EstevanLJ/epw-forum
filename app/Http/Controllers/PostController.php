<?php

namespace App\Http\Controllers;

use App\Post;
use App\Area;
use App\PostEdit;

use JavaScript;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Validator;

class PostController extends Controller
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
        $posts = Post::with('area', 'author')->orderBy('created_at', 'desc')->take(6)->get();
        
        return view('posts', compact('posts'));
    }
    
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $areas = Area::all();
        
        return view('forms.post', compact('areas'));
    }
    
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $messages = [
        'title.required' => 'O título é obrigatório',
        'text.required' => 'O texto é obrigatório',
        'area_id.required' => 'A área é obrigatória',
        'area_id.exists' => 'Por favor, selecione uma área válida',
        'title.unique_in_area' => 'Já existe um post com o mesmo título, escolha outro',
        ];
        
        $validator = Validator::make($request->all(), [
        'area_id' => 'required|exists:area,id',
        'title' => 'required|max:240|unique_in_area:'.$request->input('area_id'),
        'text' => 'required',
        ], $messages);
        
        if ($validator->fails()) {
            
            $errors = $validator->errors();
            $areas = Area::all();
            
            //return view('forms.post', compact('areas', 'errors'));
            
            return redirect(route('post.create'))
            ->withErrors($validator)
            ->withInput();
        }
        
        $post = Post::create([
        'title' => $request->input('title'),
        'text' => $request->input('text'),
        'area_id' => $request->input('area_id'),
        'user_id' => Auth::id()
        ]);
        
        //return response()->json($area);
        return redirect($post->getUrl());
    }
    
    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show(Post $post)
    {
        $post->load('author', 'area', 'comments');
        
        // JavaScript::put([
        //     'post_id' => $post->id
        // ]);

		if(Auth::id() != $post->user_id && !Auth::user()->isAdmin()) {
			$post->addVisualization();
		}
        
        return view('post', compact('post'));
    }
    
    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        
        if(Auth::user()->cant('update', $post)) {
            abort(401);
        }
        
        return view('forms.post-update', compact('post'));
    }
    
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        
        if(Auth::user()->cant('update', $post)) {
            abort(401);
        }
        
        $messages = [
        'text.required' => 'O texto é obrigatório',
        ];
        
        $validator = Validator::make($request->all(), [
        'text' => 'required',
        ], $messages);
        
        if ($validator->fails()) {
            
            $errors = $validator->errors();
            
            return redirect(route('post.edit', $post->id))
            ->withErrors($validator)
            ->withInput();
        }
        
        PostEdit::create([
        'text' => $request->input('text'),
        'user_id' => Auth::id(),
        'post_id' => $post->id
        ]);
        
        $post->updated_at = Carbon::now();
        $post->save();
        
        return redirect(route('post.show', $post->id));
    }
    
    public function history($id) {
        
        $post = Post::with('edits')->findOrFail($id);
        $post->edits = $post->edits->sortByDesc('data');
        
        return view('post-edits', compact('post'));
    }
    
    /**
    * Archive the post
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function archive($id)
    {
        $post = Post::findOrFail($id);
		        
		//Verifies if the post ins't already archived
        if($post->isArchived()) {
            return back()->withErrors(array('message' => 'O post já está arquivado!'));
        }
        
		//Verifies if the user can archive this post
        if(Auth::user()->cant('archive', $post)) {
            return back()->withErrors(array('message' => 'Você não está autorizado a arquivar este post!'));
        }

		$post->archived = true;
		$post->archived_date = Carbon::now();
		$post->archived_by = Auth::id();
		$post->save();      
        
        // return response()->json($post);
        return redirect(route('post.show', $post->id));
    }
}