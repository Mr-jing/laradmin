<?php

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    // 后台入口
    Route::get('/', ['uses' => 'AdminController@index']);
});
