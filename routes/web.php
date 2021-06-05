<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

########## Files Routes ###########
Route::get('allfiles','FileController@index')->name('allfiles');
Route::get('file/create','FileController@create')->name('file.create');
Route::post('file/create','FileController@store')->name('file.store');
//Edit
Route::get('file/edit/{id}','FileController@edit')->name('file.edit');
Route::post('file/edit/{id}','FileController@update')->name('file.update');
//View
Route::get('file/show/{id}','FileController@show')->name('file.show');
//download
Route::get('file/download/{id}','FileController@download')->name('file.download');
//Delete
Route::get('file/delete/{id}','FileController@destroy')->name('file.delete');
//public
Route::get('file/public','FileController@public')->name('publicFile.public');
Route::get('file/share/{id}','FileController@share')->name('publicFile.share');
Route::post('file/share','FileController@shareTo')->name('publicFile.shareTo');
Route::get('file/shareToMe','FileController@toMeShow')->name('publicFile.shareToMe');
Route::post('file/shareToAll/{id}','FileController@shareToAll')->name('publicFile.shareToAll');
Route::post('file/makePrivate/{id}','FileController@makePrivate')->name('publicFile.makePrivate');
Route::get('file/sheredelete/{id}','FileController@publicdestroy')->name('publicFile.sheredelete');









