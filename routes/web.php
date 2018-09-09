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

Route::middleware('auth')->group(function(){

    Route::get('/', 'PagesController@index');
    Route::get('/home', 'PagesController@index');
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout' );
    Route::get('/updatestatus/{id}','TaskController@updatestatus')->name('updatestatus');
    Route::post('/sendinvitation','TaskController@sendinvitation')->name('sendinvitation');
    Route::get('/acceptinvitation/{id}','TaskController@acceptinvitation')->name('acceptInv');
    Route::get('/denyinvitation/{id}','TaskController@denyinvitation')->name('denyInv');
    Route::get('/deleteworker/{id}','TaskController@denyinvitation')->name('deleteworker');
    Route::get('/addadmin','PagesController@addadmin')->name('addadmin');
    Route::post('/addadmin','PagesController@add_admin')->name('add_admin');

});
Route::resource('tasks','TaskController');

Auth::routes();


