<?php

namespace App;

use App\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'area';
    
    protected $fillable = [
    'name', 'description'
    ];
    
    public function posts() {
        return $this->hasMany('App\Post', 'area_id', 'id');
    }
    
    public function getPostsCount() {
        return DB::table('post')->where('area_id', $this->id)->count();
    }

    public function getCommentsCount() {
        return DB::table('comment')
                    ->join('post', 'comment.post_id', '=', 'post.id')
                    ->where('post.area_id', $this->id)->count();
    }

	public function lastPost() {
		$post = Post::where('area_id', $this->id)->orderBy('id', 'desc')->first();
		$post->load('author');
		return $post;
	}

    public function getUrl() {
        return route('area', $this->id);
    }
    
}