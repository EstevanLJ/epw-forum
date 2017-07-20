<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class ValidatorExtendServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('unique_in_area', function ($attribute, $value, $parameters, $validator) {
            $area_id = $parameters[0];
			$area = \App\Area::find($area_id);

			if(is_null($area)) {
				return true;
			}
			
			return !$area->existsPostTitle($value);
        });

		Validator::extend('unique_email_update', function ($attribute, $value, $parameters, $validator) {
            $user_id = $parameters[0];
			$user = \App\User::find($user_id);
			
			if($user->email == $value) {
				return true;
			}

			if(\App\User::where('email', $value)->count() >= 1) {
				return false;
			}

			return true;	
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
