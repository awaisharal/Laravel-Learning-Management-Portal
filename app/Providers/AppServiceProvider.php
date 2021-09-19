<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Instructor;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    public function boot()
    {
        //compose all the views....
        view()->composer('*', function ($view) 
        {
            if(session()->has('InstructorEmail')){
                $user = Instructor::where('email', session()->get('InstructorEmail'))->get();
                $view->with('user', $user[0]);    
            }
        });  
    }
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
}
