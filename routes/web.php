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
    return redirect('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('profile', 'HomeController@profile')->name('profile')->middleware('auth');

Route::get('editcomment/{id}', 'CommentController@formEdit')->name('editComment')->middleware('auth');
Route::get('deletecomment/{id}', 'CommentController@deleteComment')->name('deleteComment')->middleware('auth');
Route::post('comment', 'CommentController@store')->name('storeComment')->middleware('auth');
Route::post('commentedit', 'CommentController@actionEdit')->name('actionEditComment')->middleware('auth');

Route::post('profile', 'UserController@updateUser')->name('useredit')->middleware('auth');
