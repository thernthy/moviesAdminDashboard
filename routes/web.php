<?php

use Doctrine\DBAL\Schema\Index;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use crocodicstudio\crudbooster\controllers\AdminController;
//==============================================

//======     Public route         ==================

//=================================================
Route::get('/', 'HomeController@index');
Route::get('/video/category/{categoryName}', 'HomeController@PageCategory');
Route::get('/video/category/{categoryName}', 'HomeController@PageCategory');
Route::get('/movie/{name}/{episode}/{title}', 'HomeController@videoWach');
Route::get('board/free_list', 'HomeController@listChart');
Route::get('notice/', 'HomeController@notice');
Route::post('/leavecomment', 'HomeController@leavecomment');
Route::get('/movie/favoriteset', 'HomeController@favoriteHandle')->name('favoriteHandle');
Route::get('search/', 'HomeController@searchHandle');
//==============================================

//======     User route         ==================

//=================================================
Route::middleware(['auth.user'])->group(function () {
    Route::prefix('/user/{username}')->group(function () { 
        Route::get('/', function ($username) {
            $session = Session();
            $data['key_words'] = DB::table('keywords')->pluck('title')->toArray();
            return view('front/user/index', compact('data'))->with(['username' => $username, 'session' => $session]);
        })->name('user.dashboard');
        Route::get('/watchlater', function ($username) { 
            $session = Session();
            $data['key_words'] = DB::table('keywords')->pluck('title')->toArray();
            $data['videoSaved'] = DB::table('save_movies')
            ->join('videos', 'videos.id', 'save_movies.video_id')
            ->join('titles', 'titles.id', 'videos.title_id')
            ->join('movie_category', 'movie_category.id', 'titles.movie_category_id')
            ->where('save_movies.user_id', Session()->get('admin_id'))
            ->get();
            return view('front/user/watchlater')->with(['username' => $username, 'session' => $session, 'data' => $data]);
        })->name('user.watchlater'); 
        
        Route::get('/favorite', function ($username) { 
            $data['key_words'] = DB::table('keywords')->pluck('title')->toArray();
            $session = Session();
            $data['favorite_movies'] = DB::table('favorite_movies')
            ->join('videos', 'videos.id', 'favorite_movies.video_id')
            ->join('titles', 'titles.id', 'videos.title_id')
            ->join('movie_category', 'movie_category.id', 'titles.movie_category_id')
            ->where('favorite_movies.user_id', Session()->get('admin_id'))
            ->get();
            return view('front/user/favorate')->with(['username' => $username, 'session' => $session, 'data' => $data]);
        })->name('user.favorite'); 
        
        Route::get('/history', function ($username) { 
            $data['key_words'] = DB::table('keywords')->pluck('title')->toArray();
            $session = Session();
            $data['history'] = DB::table('history')
            ->select()
            ->join('videos', 'videos.id', 'history.video_id')
            ->join('titles', 'titles.id', 'videos.title_id')
            ->where('user_id', Session()->get('admin_id'))
            ->OrderBy('history.created_at', 'DESC')
            ->get();
            return view('front/user/history', compact('data'))->with(['username' => $username, 'session' => $session]);
        })->name('user.history'); 
        Route::post('/requstEdite/{user_id}', 'HomeController@requstEdite')->name('user.requstEdite'); 
    });
});

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
//==============================================

//======     Ajext route request         ==================

//=================================================
Route::get('/movie/details', 'HomeController@details');
Route::get('/movie/save', 'HomeController@saveMovies');
Route::post('/admin/crawler', 'AdminCrawlBoardController@BoardCrawler');
Route::post('/scrapping', 'AdminLinkScraperController@view');
Route::post('/savedata', 'AdminLinkScraperController@savedata');

//==============================================

//======     Error route          ==================

//=================================================
Route::get('/error-page', function () {
    return view('error_pages.errors');
})->name('error-page', ['message' =>  'Sorry you can not access to this pages']);



