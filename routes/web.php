<?php

use App\Http\Controllers\AccountsController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\ServerController;
use Illuminate\Support\Facades\Route;

Route::get('/api', function () {
    return view('api');
});

Route::get('/feed/{feed}', [FeedController::class, 'show']);
Route::post('/parse', [FeedController::class, 'parse'])->name('parse');

Route::get('/', [ServerController::class, 'index'])->name('servers.index');
Route::name('servers.')->prefix('servers')->controller(ServerController::class)->group(function () {
    Route::get('/', function () { return redirect('/'); });
    Route::get('add', 'add')->name('add');
    Route::post('/', 'create')->name('create');
    Route::get('/confirmation/{token}', 'createConfirmation')->name('create_confirmation');
});

Route::redirect('/account/login', '/account/recover')->name('login');
Route::redirect('/register', '/account/register');
Route::name('accounts.')->prefix('account')->controller(AccountsController::class)->group(function () {
    Route::post('authenticate', 'requestAuthentication')->name('requestAuthentication');
    Route::get('authenticate/{key}', 'authenticate')->name('authenticate');
    Route::get('recover', 'recover')->name('recover');

    Route::middleware(['auth:panel'/*, 'auth.account'*/])->group(function () {
        Route::get('panel', 'panel')->name('panel');
        Route::get('logout', 'logout')->name('logout');
        Route::get('password', 'changePassword')->name('changePassword');
        Route::post('password', 'setChangePassword')->name('setChangePassword');
        Route::get('uploaded', 'uploaded')->name('uploaded');
    });
    Route::get('register', 'create')->name('register');
    Route::get('resolve/{nickname}', 'resolveNickname')->name('resolve');
    Route::post('/', 'store')->name('store');
});

Route::get('/legals', [AccountsController::class, 'legals']);
