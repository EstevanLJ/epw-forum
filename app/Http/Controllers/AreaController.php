<?php

namespace App\Http\Controllers;

use App\Area;
use Illuminate\Http\Request;
use Validator;

class AreaController extends Controller
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
        $areas = Area::all();
        
        return view('areas', compact('areas'));
    }

	/**
     * Display the posts from the area.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function getPosts(Area $area)
    {
        $area->load('posts');
        
        return response()->json($area->posts);
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
        'name' => 'required|unique:area|max:240',
        'description' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
            'errors' => $validator->errors(),
            'inputs' => $request->all()
            ]);
        }
        
        $area = Area::create([
        'name' => $request->input('name'),
        'description' => $request->input('description')
        ]);
        
        return response()->json($area);
    }
    
    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show(Area $area)
    {
        $area->load('posts');
        
        $posts = $area->posts;
        
        return view('posts', compact('area', 'posts'));
    }
    
    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        //
    }
    
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Area $area)
    {
        //Verifica se a requisição tem os campos
        $validator = Validator::make($request->all(), [
        'name' => 'required',
        'description' => 'required'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
            'errors' => $validator->errors(),
            'inputs' => $request->all()
            ]);
        }
        
        //Verifica se vai atualizar o name
        if($area->name != $request->input('name')) {
            //Se atualizar, certifica que já não existe algum igual
            $validator = Validator::make($request->all(), [
            'name' => 'required|unique:area|max:240',
            'description' => 'required',
            ]);
            
            if ($validator->fails()) {
                return response()->json([
                'errors' => $validator->errors(),
                'inputs' => $request->all()
                ]);
            }
        }
        
        //Caso passe na validação, atualiza a Area
        $area->name = $request->input('name');
        $area->description = $request->input('description');
        
        $area->save();
        
        return response()->json($area);
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