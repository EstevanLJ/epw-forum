<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
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
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
