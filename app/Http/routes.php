<?php

Route::group(['middleware' => 'web'], function () {
    Route::get('/',     'HomeController@index');
    Route::get('/home', 'HomeController@index');

    Route::auth();

    Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){
      Route::get('/',           ['uses' => 'HomeController@index', 'role' => 'admin_system_view']);
      Route::get('system',      ['uses' => 'SystemController@index', 'role' => 'admin_system_view']);
      Route::get('system/edit', ['uses' => 'SystemController@index', 'role' => 'admin_system_edit']);
    });

});
