<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::controller('admin/auth', 'Admin\AuthController');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'role.route'], function () {
    // 后台入口
    Route::get('/', ['uses' => 'AdminController@index']);

    // 菜单显示
    Route::resource('menus', 'MenuController');
    Route::post('/menus/{menus}/setting', ['uses' => 'MenuController@postSetting']);

    // 访问权限
    Route::resource('routes', 'RouteController');
    Route::post('/routes/{routes}/setting', ['uses' => 'RouteController@postSetting']);

    // 用户角色
    Route::resource('roles', 'RoleController', ['except' => ['show']]);
});
