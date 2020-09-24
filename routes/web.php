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

Route::middleware(['auth'])->group(function () {
	Route::get('profile/{group}', ['uses' => 'DefaultController@profile','as' => 'profile']);
	Route::post('group-update', ['uses' => 'DefaultController@groupupdate','as' => 'group-update']);
	Route::post('group-create', ['uses' => 'DefaultController@groupcreate','as' => 'group-create']);
	Route::post('group-delete/{id}', ['uses' => 'DefaultController@groupdelete','as' => 'group-delete']);
	Route::post('group-sort', ['uses' => 'DefaultController@groupsort','as' => 'group-sort']);
	Route::post('profile-update', ['uses' => 'DefaultController@profileupdate','as' => 'profile-update']);
	Route::post('election-update', ['uses' => 'DefaultController@update','as' => 'election-update']);
	Route::post('election-create', ['uses' => 'DefaultController@create','as' => 'election-create']);
	Route::get('election-clone/{id}', ['uses' => 'DefaultController@clonecreate','as' => 'election-clone']);
	Route::post('election-delete/{id}', ['uses' => 'DefaultController@delete','as' => 'election-delete']);
	Route::post('election-sort', ['uses' => 'DefaultController@electionsort','as' => 'election-sort']);
});
Route::get('election-data/{group}', ['uses' => 'DefaultController@data','as' => 'election-data']);
Route::get('/home','DefaultController@index');
Route::get('show/{group_ids}', ['uses' => 'DefaultController@show','as' => 'show']);
Route::get('/','DefaultController@index');

Route::get('autologin', function () {
    Auth::loginUsingId(1);
    return redirect(route('profile',['group' => 'home']));
});
Auth::routes();