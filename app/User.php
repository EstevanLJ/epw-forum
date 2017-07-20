<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;

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

	public function lastPosts($number = 5) {
		return Post::where('user_id', '=', $this->id)->orderByDesc('date')->limit($number)->get();
	}

    public function comments() {
        return $this->hasMany('App\Comment', 'user_id', 'id');
    }

	public function isAdmin() {
		return $this->id == 1;
	}

	public function isActive() {
		return $this->active == 1;
	}

    public function getFullName() {
		$firsts = explode(' ', $this->first_name);
		$lasts = explode(' ', $this->last_name);

		$all = array_merge($firsts, $lasts);
		$allok = array();

		foreach($all as $a) {
			$allok[] = ucfirst(strtolower($a));
		}

        return implode(' ', $allok);
    }

    public function getAvatarUrl($px = 200) {
        if(AVATAR_PROVIDER == 'adorable') {
            return get_adorable($this->email, $px);
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
        return route('user', $this->user_name);
    }

	public function isEqual(Request $request) {
		return $this->first_name == $request->input('first_name') &&
				$this->last_name == $request->input('last_name') &&
				$this->email == $request->input('email') &&
				$this->active == $request->input('active');
	}
}
