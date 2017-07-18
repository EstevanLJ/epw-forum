<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    

	public function searchPost(Request $request) {

		if(!$request->has('search')) {
			abort(401);
		}

		$search = $request->input('search');

		$results = DB::table('post')
						->select('post.id')
						->leftJoin('post_edit', 'post_edit.post_id', '=', 'post.id');
						
		if($request->has('area')) {
			$results = $results->where('post.area_id', $request->input('area'));
		}

		$results = $results->where('post.title', 'like', '%'.$search.'%')
				->orWhere('post.text', 'like', '%'.$search.'%')
				->orWhere('post_edit.text', 'like', '%'.$search.'%')
				->groupBy('post.id')
				->get();


		$ids = array();
		foreach($results as $result) {
			$ids[] = $result->id;
		}

		$posts = Post::find($ids);

		return view('search-result', compact('posts', 'search'));

	}


}
