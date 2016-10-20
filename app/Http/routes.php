<?php

Route::get('/', function () {
    return redirect('admin');
});

Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::controller('admin/auth', 'Admin\AuthController');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'role.route'], function () {
    // 后台入口
    Route::get('/', ['uses' => 'AdminController@index']);

    // 菜单显示
    Route::resource('menus', 'MenuController', ['except' => ['show']]);
    Route::get('/menus/{menus}/roles', ['uses' => 'MenuController@getRoles']);
    Route::post('/menus/{menus}/roles', ['uses' => 'MenuController@postRoles']);

    // 访问权限
    Route::resource('routes', 'RouteController', ['except' => ['show']]);
    Route::get('/routes/{routes}/roles', ['uses' => 'RouteController@getRoles']);
    Route::post('/routes/{routes}/roles', ['uses' => 'RouteController@postRoles']);

    // 用户角色
    Route::resource('roles', 'RoleController', ['except' => ['show']]);
    Route::get('/roles/{roles}/routes', ['uses' => 'RoleController@getRoutes']);
    Route::post('/roles/{roles}/routes', ['uses' => 'RoleController@postRoutes']);
    Route::get('/roles/{roles}/menus', ['uses' => 'RoleController@getMenus']);
    Route::post('/roles/{roles}/menus', ['uses' => 'RoleController@postMenus']);

    // 用户管理
    Route::resource('users', 'UserController', ['except' => ['show']]);

});
