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

// Console
Route::get('/console', 'ConsoleController@index')->name('console.dashboard');
Route::get('/console/reports/{report}', 'ConsoleController@showReport')->name('console.reports.show');

// Servers
Route::resource('/servers', 'ServerController');
Route::get('/servers/{server}/panel', 'ServerController@showPanel')->name('servers.show.panel');
Route::get('/servers/types/{type}', 'ServerTypeController@index');
Route::get('/servers/versions/{version}', 'VersionController@index');
Route::get('/servers/countries/{country}', 'CountryController@index');

// ServerVerifications
Route::get('/servers/{server}/verifications/create', 'ServerVerificationController@create')->name('servers.verifications.create');
Route::post('/servers/{server}/verifications', 'ServerVerificationController@store')->name('servers.verifications.store');

// ServerReports
Route::get('/servers/{server}/reports/create', 'ReportServerController@create')->name('servers.reports.create');
Route::post('/servers/{server}/reports', 'ReportServerController@store')->name('servers.reports.store');

// ServerVotes (does not follow naming conventions)
Route::get('/servers/{server}/vote', 'ServerVoteController@create')->name('servers.votes.create');
Route::post('/servers/{server}/votes', 'ServerVoteController@store')->name('servers.votes.store');

// Users
Route::get('/user/settings/account', 'UserSettingsController@editAccount');
Route::get('/user/settings/security', 'UserSettingsController@editSecurity');
Route::patch('/user/settings/account', 'UserSettingsController@updateAccount');
Route::patch('/user/settings/security', 'UserSettingsController@updateSecurity');
Route::get('/user/dashboard', 'HomeController@indexDashboard')->name('user.dashboard'); // To be updated

// Home
Route::get('/', 'HomeController@index')->name('home');

// Support
Route::get('/support', 'SupportController@index');
Route::get('/support/privacy-policy', 'SupportController@showPrivacyPolicy');
Route::get('/support/terms-of-service', 'SupportController@showTermsOfService');
Route::get('/support/rules', 'SupportController@showRules');
