<?php

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    // 后台入口
    Route::get('/', ['uses' => 'AdminController@index']);

    // 菜单显示
    Route::resource('menus', 'MenuController');
    Route::post('/menus/{menus}/setting', ['uses' => 'MenuController@postSetting']);

    // 访问权限
    Route::resource('routes', 'RouteController', ['except' => ['show']]);

    // 用户角色
    Route::resource('roles', 'RoleController', ['except' => ['show']]);
});
