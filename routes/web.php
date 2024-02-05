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
    Route::get('pr', function(){
        $session = Session();
        return view('front/user.index', compact('session'));
    });
}

Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');
