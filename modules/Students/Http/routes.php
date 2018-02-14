<?php

Route::group(['prefix' => 'alunos', 'namespace' => 'Modules\Students\Http\Controllers', 'as' => 'students.'], function()
{
	Route::get('/',               ['as' => 'index',  'uses' =>  'StudentsController@index']);
	Route::get('/novo',           ['as' => 'create', 'uses' =>  'StudentsController@create']);
	Route::post('/store',         ['as' => 'store',  'uses' =>  'StudentsController@store']);
	Route::get('/edita/{id}',     ['as' => 'edit',   'uses' =>  'StudentsController@edit']);
	Route::post('/atualiza/{id}', ['as' => 'update', 'uses' =>  'StudentsController@update']);
	Route::get('/deleta/{id}',   ['as' => 'delete', 'uses' =>  'StudentsController@delete']);
});