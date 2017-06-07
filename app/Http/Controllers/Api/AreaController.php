<?php

namespace App\Http\Controllers\Api;

use App\Area;
use Validator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Area::all(['id', 'name', 'description']);

        return response()->json($areas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
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
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area)
    {
        return response()->json($area);
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit(Area $area)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Area  $area
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
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area)
    {
        //
    }
}
