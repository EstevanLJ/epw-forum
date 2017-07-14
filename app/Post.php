<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'post';
    
    protected $fillable = [
    'title', 'text', 'user_id', 'area_id'
    ];
    
    //Comments
    public function comments() {
        return $this->hasMany('App\Comment', 'post_id', 'id');
    }
    
    public function getCommentsCount() {
        return DB::table('comment')->where('post_id', $this->id)->count();
    }
    
    public function getLastComment() {
        return DB::table('comment')->where('post_id', $this->id)->orderBy('id', 'desc')->first();
    }
    
    //Edits
    public function edits() {
        return $this->hasMany('App\PostEdit', 'post_id', 'id');
    }
    
    public function wasEdited() {
        return DB::table('post_edit')->where('post_id', $this->id)->count() > 0;
    }
    
    public function getLastText() {
        if($this->wasEdited()) {
            return $this->edits->last()->text;
        } else {
            return $this->text;
        }
    }
    
    //Archive
    public function archivedBy() {
        return $this->hasOne('App\User', 'id', 'archived_by');
    }
    
    public function isArchived() {
        return boolval($this->archived);
    }    
    
    //Misc
    public function area() {
        return $this->hasOne('App\Area', 'id', 'area_id');
    }
    
    public function author() {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
        
    public function getUrl() {
        return route('post.show', $this->id);
    }

	public function addVisualization() {
		$this->visualizations = $this->visualizations + 1;
		$this->save();
	}

}