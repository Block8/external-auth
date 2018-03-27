<?php

Route::middleware('web')->group(function () {
    Route::get('/auth/redirect/{provider}', 'Block8\ExternalAuth\Http\Controllers\AuthController@redirect')->name('b8.auth.redirect');
    Route::get('/auth/callback/{provider}', 'Block8\ExternalAuth\Http\Controllers\AuthController@callback')->name('b8.auth.callback');
    Route::get('/auth/logout/{provider}', 'Block8\ExternalAuth\Http\Controllers\AuthController@logout')->name('b8.auth.logout');
});
