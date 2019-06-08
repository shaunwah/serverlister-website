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

// Auth
Auth::routes();

// Servers
Route::resource('/servers', 'ServerController');
Route::get('/servers/{server}/panel', 'ServerController@showPanel')->name('servers.show.panel');
Route::get('/servers/types/{type}', 'ServerTypeController@index');
Route::get('/servers/versions/{version}', 'VersionController@index');
Route::get('/servers/countries/{country}', 'CountryController@index');

// ServerComments
// Route::post('/servers/{server}/comments', 'ServerCommentController@store')->name('servers.comments.store');

// ServerVotes
Route::post('/servers/{server}/votes', 'ServerVoteController@store')->name('servers.votes.store');
Route::get('/servers/{server}/vote', 'ServerVoteController@create')->name('servers.votes.create');

// Users
Route::get('/user/settings/account', 'UserSettingsController@editAccount');
Route::get('/user/settings/security', 'UserSettingsController@editSecurity');
Route::patch('/user/settings/account', 'UserSettingsController@updateAccount');
Route::patch('/user/settings/security', 'UserSettingsController@updateSecurity');

// Etc
Route::get('/', function () {
    return view('index');
})->name('index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/support', function () { return view('support.index'); });
Route::get('/support/privacy-policy', function () { return view('support.privacy_policy'); });
