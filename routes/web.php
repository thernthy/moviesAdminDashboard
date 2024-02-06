<?php

use Doctrine\DBAL\Schema\Index;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;



Route::get('/', 'HomeController@index');
Route::get('/video/category/{categoryName}', 'HomeController@PageCategory');
Route::get('video/category/{categoryName}/{part}/{movieTile}', 'HomeController@videoWach');

//==============================================

//======     User route         ==================

//=================================================
if(Session()){
        Route::prefix('/user/{username}')->group(function () { 
        // Define a route for the user dashboard 
        Route::get('/', function ($username) { 
            return view('front/user/index')->with($username); 
        })->name('user.dashboard'); 

        Route::get('/favorite', function ($username) { 
            return view('front/user/favorate')->with('username', $username);
        })->name('user.favorite'); 
        Route::get('/history', function ($username) { 
            return view('front/user/history')->with('username', $username);
        })->name('user.history'); 
        Route::get('/', function ($username) { 
            return view('front/user/history')->with('username', $username);
        })->name('user.history'); 
    });
}
Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');
