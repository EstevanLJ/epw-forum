<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostEdit extends Model
{
    protected $table = 'post_edit';

	public $timestamps = false;

    protected $fillable = [
        'text', 'user_id', 'post_id'
    ];

	public function post() {
        return $this->hasOne('App\Post', 'id', 'post_id');
    }
}
