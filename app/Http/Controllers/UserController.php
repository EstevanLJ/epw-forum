<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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
        if(!Auth::user()->isAdmin()) {
			abort(401);
		}

		$users = User::all();
		return view('admin.users.index', compact('users'));		
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($user)
    {
		Log::info($user);

		$user = User::where('user_name', '=', $user)->firstOrFail();

        $user->load('posts', 'comments');

        return view('user', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Auth::user()->isAdmin()) {
			abort(401);
		}
		
		$user = User::findOrFail($id);
		return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if(!Auth::user()->can('update', $user)) {
			abort(401);
		}

		$messages = [
        	'first_name.required' => 'O nome é obrigatório',
        	'first_name.max' => 'O nome não pode ser maior do que 240 caracteres',
        	'last_name.required' => 'O sobrenome é obrigatório',
        	'last_name.max' => 'O sobrenome não pode ser maior do que 240 caracteres',
        	'email.required' => 'O e-mail é obrigatório',
        	'email.unique' => 'Este e-mail já está sendo utilizado por outro usuário',
        ];
        
        $validator = Validator::make($request->all(), [
			'first_name' => 'required|max:240',
			'last_name' => 'required|max:240',
			'email' => 'required|unique:user',
        ], $messages);
        
        if ($validator->fails()) {
            return redirect(route('user.edit', $user->id))
            ->withErrors($validator)
            ->withInput();
        }


		return redirect(route('user.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
