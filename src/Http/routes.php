<?php

Route::group([
    'namespace' => 'CryptaEve\Seat\Text\Http\Controllers',
    'middleware' => ['web', 'auth'],
    'prefix' => 'text'
], function () {
    
    Route::get('/list', [
        'as'   => 'text.list',
        'uses' => 'TextController@getConfigureView',
        'middleware' => 'can:text.edit'
    ]);

    Route::get('/gettextbyid/{id}', [
        'as'   => 'text.textbyid',
        'uses' => 'TextController@getTextByID',
        'middleware' => 'can:text.edit'
    ]);

    Route::post('/postpagenew', [
        'as'   => 'text.createText',
        'uses' => 'TextController@postNewPage',
        'middleware' => 'can:text.edit'
    ]);

    Route::get('/deltextbyid/{id}', [
        'as'   => 'text.deletePage',
        'uses' => 'TextController@deletePageById',
        'middleware' => 'can:text.edit'
    ]);

    Route::get('/about', [
        'as'   => 'text.about',
        'uses' => 'TextController@getAboutView',
        'middleware' => 'can:text.edit'
    ]);

    Route::get('/instructions', [
        'as'   => 'text.instructions',
        'uses' => 'TextController@getInstructionsView',
        'middleware' => 'can:text.edit'
    ]);
    
});

Route::group([
    'namespace' => 'CryptaEve\Seat\Text\Http\Controllers',
    // 'middleware' => ['web', 'auth'],
    'prefix' => 'public'
], function () {
    Route::get('/{url}', [
        'as'   => 'text.public',
        'uses' => 'TextController@getPublicText'
    ]);
});
