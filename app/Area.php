<?php

namespace App;

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
    
}
