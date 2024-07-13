<?php

use Doctrine\DBAL\Schema\Index;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use crocodicstudio\crudbooster\controllers\AdminController;

use crocodicstudio\crudbooster\controllers\AdminComicDataScrapperController;
//use App\Http\Controllers\Api\ComicController;
use App\Http\Middleware\ApiKeyAuthentication;
use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ComicController;
//==============================================

//======     Public route         ==================

//=================================================
Route::get('/', function() {
    $data['key_words'] = DB::table('keywords')->pluck('title')->toArray();
    return view('auth.login', compact('data'));
});

Route::get('/viewDeteled', function() {
    $data['key_words'] = DB::table('keywords')->pluck('title')->toArray();
    $data['videos'] = DB::table('videos')->limit(10)->get();
    $data['tartget'] = [];
    foreach($data['videos'] as $item){
        // Fetch titles except the one associated with the current video
        $titles = DB::table('titles')->where('id', '!=', $item->title_id)->get();  
        $data['tartget'][] = $titles;
    }
    return view('front.deletForm', compact('data'));
});


//==============================================

//======     Admin route         ==================

//=================================================
Route::post('/change-language', 'AdminController@changeLanguage')->name('language.change');
Route::get('/autoPost', 'AdminController@autoPost');

Route::get('/logms', function () {
    $logs = file(storage_path('logs/laravel.log'));
    return response()->json($logs);
});


Route::post('/admin/dosearch', 'AdminComicDataScrapperController@dosearch')->name('dosearch');
Route::post('/admin/dosave', 'AdminComicDataScrapperController@dosave')->name('dosave');


//==============================================

//======     Accessing router          ==================

//=================================================
Route::middleware(['guest'])->group(function () {
    Route::get('/login', function () {
        $data['key_words'] = DB::table('keywords')->pluck('title')->toArray();
        return view('auth.login', compact('data'));
    })->name('login');
    Route::get('/register', function() {
        $data['key_words'] = DB::table('keywords')->pluck('title')->toArray();
        return view('auth/register', compact('data'));
    })->name('register');
});
Route::post('/logout', [AdminController::class, 'getLogout'])->name('logout');

Route::post('/registerPost', 'HomeController@registerPost')->name('registerPost');