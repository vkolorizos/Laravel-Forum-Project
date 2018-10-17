<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Channel;
use Cache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \View::composer('*', function($view){
        	$channels = \Cache::rememberForever('channels', function (){
        		return Channel::all();
	        });
        	$view->with('channels', $channels);
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
