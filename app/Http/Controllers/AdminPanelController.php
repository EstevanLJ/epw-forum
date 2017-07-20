<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPanelController extends Controller
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


    public function index() {
		
		if(!Auth::user()->isAdmin()){
			abort(401);
		}
		
		return view('admin.index');
	}
}
