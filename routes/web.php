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

Route::get ('/','GuestController@firstpage')->name('firstpage');

Route::get('/app', function(){
	return view('layouts.app');
});

Auth::routes(["verify"=>true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/test', 'HomeController@testpage')->name('test');

Route::post('/storePost', 'PostsController@storePosts')->name('storePosts');

Route::get('/editPost/{id}', 'PostsController@edit')->name('edit');

Route::post('/updatepost', 'PostsController@update')->name('updatepost');

Route::post("/delete", "PostsController@delete")->name("adminDelete");

Route::post('/addlike', "LikesController@addlike")->name("addlike");

Route::get('/addcomments/{id}', "HomeController@showcomments")->name("showcomments");

Route::post('/storeComment', "HomeController@storeComment")->name('storeComments');

Route::post('/addcommentlike', "HomeController@storeLikes")->name('storelikes');

Route::post('/search', "GuestController@search")->name('searchChamp');

Route::post('/profile', "GuestController@profile")->name('profile');


