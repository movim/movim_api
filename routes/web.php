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

Route::get('/api', function () {
    return view('api');
});

Route::get('/feed/{feed}', 'FeedController@show');
Route::post('/parse', 'FeedController@parse');

//Auth::routes();

/* Accounts */
Route::get('/', 'AccountsController@login')->name('accounts.login');
Route::post('/authenticate', 'AccountsController@requestAuthentication')->name('accounts.requestAuthentication');
Route::get('/authenticate/{key}', 'AccountsController@authenticate')->name('accounts.authenticate');

Route::group(['middleware' => ['auth:panel'/*, 'auth.account'*/]], function () {
    Route::get('/panel', 'AccountsController@panel')->name('accounts.panel');
    Route::get('/logout', 'AccountsController@logout')->name('accounts.logout');
    Route::get('/password', 'AccountsController@changePassword')->name('accounts.changePassword');
    Route::post('/password', 'AccountsController@setChangePassword')->name('accounts.setChangePassword');
    Route::get('/emailtoxmpp', 'AccountsController@emailToXMPP')->name('accounts.emailToXMPP');
    Route::get('/emailtoxmpp/{enabled}', 'AccountsController@setEmailToXMPP')->name('accounts.setEmailToXMPP');
    Route::get('/uploaded/', 'AccountsUploadedController@index')->name('accounts.uploaded');
});

Route::get('/register', 'AccountsController@create')->name('accounts.register');
Route::get('/resolve/{nickname}', 'AccountsController@resolveNickname')->name('accounts.resolve');
Route::post('/accounts/', 'AccountsController@store');
Route::get('/legals', 'AccountsController@legals');
