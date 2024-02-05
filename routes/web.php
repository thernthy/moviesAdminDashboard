<?php

use Doctrine\DBAL\Schema\Index;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
Route::post('Login', 'AuthController@login')->name('login');

Route::get('/', 'HomeController@index');
Route::get('/video/category/{categoryName}', 'HomeController@PageCategory');
Route::get('video/category/{categoryName}/{part}/{movieTile}', 'HomeController@videoWach');
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
