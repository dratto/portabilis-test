<?php

Route::group(['prefix' => 'matriculas', 'namespace' => 'Modules\Registrations\Http\Controllers', 'as' => 'registrations.'], function()
{
    Route::get('/',               ['as' => 'index',  'uses'  =>  'RegistrationsController@index']);
    Route::get('/novo',           ['as' => 'create', 'uses'  =>  'RegistrationsController@create']);
    Route::post('/store',         ['as' => 'store',  'uses'  =>  'RegistrationsController@store']);
    Route::get('/edita/{id}',     ['as' => 'edit',   'uses'  =>  'RegistrationsController@edit']);
    Route::post('/atualiza/{id}', ['as' => 'update', 'uses'  =>  'RegistrationsController@update']);
    Route::get('/deleta/{id}',    ['as' => 'delete', 'uses'  =>  'RegistrationsController@delete']);
    Route::get('/{id}',           ['as' => 'show',   'uses'  =>  'RegistrationsController@show']);
});