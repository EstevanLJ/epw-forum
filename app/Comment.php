<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comment';

    protected $fillable = [
        'comment', 'user_id', 'post_id'
    ];

    public function post() {
        return $this->hasOne('App\Post', 'id', 'post_id');
    }

    public function author() {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

}
