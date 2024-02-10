<?php

use Doctrine\DBAL\Schema\Index;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


//==============================================

//======     Public route         ==================

//=================================================
Route::get('/', 'HomeController@index');
Route::get('/video/category/{categoryName}', 'HomeController@PageCategory');
Route::get('/movie/{name}/{episode}/{title}', 'HomeController@videoWach');



//==============================================

//======     User route         ==================

//=================================================
Route::middleware(['auth.user'])->group(function () {
    Route::prefix('/user/{username}')->group(function () { 
        Route::get('/', function ($username) {
            $session = Session();
            return view('front/user/index')->with(['username' => $username, 'session' => $session]);
        })->name('user.dashboard');
        
        Route::get('/watchlater', function ($username) { 
            $session = Session();
            return view('front/user/watchlater')->with(['username' => $username, 'session' => $session]);
        })->name('user.watchlater'); 

        Route::get('/favorite', function ($username) { 
            $session = Session();
            return view('front/user/favorate')->with(['username' => $username, 'session' => $session]);
        })->name('user.favorite'); 
        
        Route::get('/history', function ($username) { 
            $session = Session();
            return view('front/user/history')->with(['username' => $username, 'session' => $session]);
        })->name('user.history'); 
        Route::post('/requstEdite/{user_id}', 'HomeController@requstEdite')->name('user.requstEdite'); 
    });
});

//==============================================

//======     Accessing router          ==================

//=================================================
Route::middleware(['auth.guest'])->group(function () {
    Route::get('/login', function () {
        return view('Auth/login');
    })->name('login');
    Route::get('/register', function() {
        return view('Auth/register');
    })->name('register');
});
Route::post('/registerPost', 'HomeController@registerPost')->name('registerPost');
//==============================================

//======     Ajext route request         ==================

//=================================================


Route::get('/movie/details', 'HomeController@details');

//==============================================

//======     Error route          ==================

//=================================================
Route::get('/error-page', function () {
    return view('error_pages.errors');
})->name('error-page', ['message' =>  'Sorry you can not access to this pages']);

Auth::routes();
