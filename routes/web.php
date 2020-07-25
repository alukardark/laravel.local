<?php

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


Route::get('/id{user_id?}', 'UserController@user');


Route::get('/form', 'UserController@form');


Route::post('/form-result', 'UserController@formResult');


Route::get('/tasks', 'UserController@tasksResult');


Route::get('/tasks/{id}', 'UserController@tasksCount');


Route::get('/logs', 'UserController@logsResult');


Route::get('/work', 'UserController@workResult');


//places
Route::get('/places', 'PlacesController@getPlaces');
Route::get('/places/create', 'PlacesController@createPlace');
Route::post('/places/add', 'PlacesController@addPlace');
Route::get('/places/{id}', 'PlacesController@getPlace');
Route::post('/places/{id}/photos/add', 'PlacesController@addPhoto');
//Route::post('/xxx','PlacesController@addPhoto')->name('insertquotation');

