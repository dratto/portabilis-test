<?php

Route::group(['prefix' => 'students', 'namespace' => 'Modules\Students\Http\Controllers'], function()
{
	Route::get('/', 'StudentsController@index');
});