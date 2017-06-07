<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'post';

    protected $fillable = [
        'title', 'text', 'user_id', 'area_id'
    ];

    public function area() {
        return $this->hasOne('App\Area', 'id', 'area_id');
    }

    public function author() {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
