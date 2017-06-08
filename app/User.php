<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'user_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts() {
        return $this->hasMany('App\Post', 'user_id', 'id');
    }

    public function getFullName() {
        return ucfirst(strtolower($this->first_name)).' '.ucfirst(strtolower($this->last_name));
    }

    public function getAvatarUrl() {
        if(AVATAR_PROVIDER == 'adorable') {
            return get_adorable($this->email);
        } 
        
        return get_gravatar($this->email);
    }

    public function getSmallAvatarUrl() {
        if(AVATAR_PROVIDER == 'adorable') {
            return get_adorable($this->email, 100);
        } 
        
        return get_gravatar($this->email, 100, 'px');
    }

    public function getUrl() {
        return route('user', $this->id);
    }
}
