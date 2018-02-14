<?php

Route::group(['prefix' => 'cursos', 'namespace' => 'Modules\Courses\Http\Controllers', 'as' => 'courses.'], function()
{
    Route::get('/',               ['as' => 'index',  'uses'  =>  'CoursesController@index']);
    Route::get('/novo',           ['as' => 'create', 'uses'  =>  'CoursesController@create']);
    Route::post('/store',         ['as' => 'store',  'uses'  =>  'CoursesController@store']);
    Route::get('/edita/{id}',     ['as' => 'edit',   'uses'  =>  'CoursesController@edit']);
    Route::post('/atualiza/{id}', ['as' => 'update', 'uses'  =>  'CoursesController@update']);
    Route::get('/deleta/{id}',    ['as' => 'delete', 'uses'  =>  'CoursesController@delete']);
});