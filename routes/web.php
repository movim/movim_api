<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/feed/{feed}', 'FeedController@show');
Route::post('/parse', 'FeedController@parse');

Auth::routes();

Route::get('/home', 'HomeController@index');

/* Accounts */
Route::get('/accounts', 'AccountsController@home')->name('accounts.home');
Route::post('/accounts/authenticate', 'AccountsController@requestAuthentication')->name('accounts.requestAuthentication');
Route::get('/accounts/authenticate/{key}', 'AccountsController@authenticate')->name('accounts.authenticate');

Route::group(['middleware' => 'auth.account'], function () {
    Route::get('/accounts/logout', 'AccountsController@logout')->name('accounts.logout');
    Route::get('/accounts/emailtoxmpp', 'AccountsController@emailToXMPP')->name('accounts.emailToXMPP');
    Route::get('/accounts/emailtoxmpp/{enabled}', 'AccountsController@setEmailToXMPP')->name('accounts.setEmailToXMPP');
});

Route::get('/accounts/register', 'AccountsController@create')->name('accounts.register');
Route::post('/accounts/', 'AccountsController@store');
Route::get('/accounts/legals', 'AccountsController@legals');

/* Pods */
Route::get('/pods/favorite',    'PodsController@favorite');

Route::post('/pods/status',     'PodsController@status');
Route::post('/pods/register',   'PodsController@store');

Route::get('/pods',             'PodsController@index');
Route::get('/servers',          'ServersController@index');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/pods/{id}',        'PodsController@show');
    Route::get('/pods/{id}/edit',   'PodsController@edit');
    Route::put('/pods/{id}',        'PodsController@update')->name('pods.update');
    Route::get('/pods/{id}/refresh','PodsController@refresh');
    Route::delete('/pods/{id}',     'PodsController@destroy');

    Route::get('/servers/{id}/edit','ServersController@edit');
    Route::put('/servers/{id}',     'ServersController@update')->name('servers.update');
    Route::get('/servers/create',   'ServersController@create');
    Route::post('/servers',         'ServersController@store')->name('servers.store');
    Route::delete('/servers/{id}',  'ServersController@destroy');
});
