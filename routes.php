<?php

Route::group(['prefix' => 'supportchat'], function () {

    Route::group(['prefix' => 'conversations'], function () {
        Route::get('/', ['as' => 'conversations.index', 'uses' => '\Aidaskni\Supportchat\SupportchatController@index'])->middleware(['web', 'auth']);
        Route::get('/{id}', ['as' => 'conversations.show', 'uses' => '\Aidaskni\Supportchat\SupportchatController@show'])->middleware(['web', 'auth']);
        Route::get('/create', ['as' => 'conversations.create', 'uses' => '\Aidaskni\Supportchat\SupportchatController@create']);
        Route::post('/create', ['as' => 'conversations.store', 'uses' => '\Aidaskni\Supportchat\SupportchatController@store']);
        Route::get('/{id}/clear', ['as' => 'conversations.clear', 'uses' => '\Aidaskni\Supportchat\SupportchatController@clearMessages'])->middleware(['web', 'auth']);
    });

    Route::get('/messages/{id}', ['uses' => 'Aidaskni\Supportchat\SupportchatController@getMessagesById'])->middleware(['web', 'auth']);
    Route::post('/messages/{id}', ['uses' => 'Aidaskni\Supportchat\SupportchatController@sendMessage'])->middleware(['web', 'auth']);
});

