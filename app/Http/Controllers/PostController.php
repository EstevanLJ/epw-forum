<?php

namespace App\Http\Controllers;

use App\Post;
use App\Area;

use JavaScript;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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

		$post->text = $request->input('text');
		$post->save();

		return redirect(route('post.show', $post->id));

		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
