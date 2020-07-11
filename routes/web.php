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
return redirect('pertanyaan');
});
Route::resource('pertanyaan','pertanyaanController');

//Route::post('jawaban/{id}/store','jawabanController@store');
Route::resource('jawaban','jawabanController');
Route::resource('komentarpertanyaan','KomentarPertanyaanController');
Route::resource('komentarjawaban','KomentarJawabanController');
//Route::post('jawaban/{id}/store','jawabanController@store');
