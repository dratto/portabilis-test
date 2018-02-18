<?php

Route::group(['prefix' => 'matriculas', 'namespace' => 'Modules\Registrations\Http\Controllers', 'as' => 'registrations.'], function()
{
    Route::get('/',               ['as' => 'index',  'uses'  =>  'RegistrationsController@index']);
    Route::get('/novo',           ['as' => 'create', 'uses'  =>  'RegistrationsController@create']);
    Route::post('/store',         ['as' => 'store',  'uses'  =>  'RegistrationsController@store']);
    Route::get('/deleta/{id}',    ['as' => 'delete', 'uses'  =>  'RegistrationsController@delete']);

    //Pagamento
    Route::get('{id}/pagamento/{paymentId}/',      ['as' => 'payment.show',   'uses'  =>  'PaymentsController@show']);
    Route::post('{id}/pagamento/{paymentId}/',     ['as' => 'payment.do',     'uses'  =>  'PaymentsController@doPayment']);
    Route::get('/pagamento/{paymentId}/troco',     ['as' => 'payment.change', 'uses'  =>  'PaymentsController@generateChange']);

    //Cancelamento
    Route::get('{id}/cancelamento', ['as' => 'cancel.index',  'uses'  =>  'RegistrationsController@cancelIndex']);
    Route::post('{id}/cancelar',    ['as' => 'cancel.store',  'uses'  =>  'RegistrationsController@cancelStore']);


    //Dashboard
    Route::get('/{id}',           ['as' => 'show',   'uses'  =>  'RegistrationsController@show']);
});