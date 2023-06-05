<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login')->name('login');
//Authにてroute('login')と指定されているので、Routeの名前を指定してあげる
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

//ログイン中のページ
Route::middleware('auth')->group(function(){
    Route::get('/top','PostsController@index');
    Route::post('/top','PostsController@index');

    Route::post('/top/update','PostsController@update')->name('top.update');;
    Route::post('/top/delete','PostsController@delete')->name('top.delete');


    Route::get('/profile','UsersController@profile');
    Route::post('/profile','UsersController@profile');

    Route::get('/user_profile','PostsController@user_profile')->name('user_profile');
    Route::post('/user_profile','PostsController@user_profile')->name('user_profile');

    Route::post('/user_profile/follow','UsersController@follow');
    Route::post('/user_profile/unfollow','UsersController@unfollow');

    Route::get('/search','UsersController@search')->name('search');

    Route::post('/search/follow','UsersController@follow');
    Route::post('/search/unfollow','UsersController@unfollow');

    Route::get('/follow-list','PostsController@follow_list');
    Route::get('/follower-list','PostsController@follower_list');

    Route::get('/logout','Auth\LogoutController@logout');
});

