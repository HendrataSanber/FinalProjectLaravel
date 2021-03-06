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

Route::get('/', function () {
//    return view('layouts.app');
return view('welcome');
//return redirect('pertanyaan');
});
Route::resource('pertanyaan','pertanyaanController');

//Route::post('jawaban/{id}/store','jawabanController@store');
Route::resource('jawaban','jawabanController');
Route::resource('komentarpertanyaan','KomentarPertanyaanController');
Route::resource('komentarjawaban','KomentarJawabanController');
//Route::post('jawaban/{id}/store','jawabanController@store');
Route::get('upvotep/{id}','VoteController@uppertanyaan');
Route::get('downvotep/{id}','VoteController@downpertanyaan');
Route::get('upvotej/{id}/{pid}','VoteController@upjawaban');
Route::get('downvotej/{id}/{pid}','VoteController@downjawaban');
Route::get('login.html',function(){
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
