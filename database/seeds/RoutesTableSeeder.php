<?php

use Illuminate\Database\Seeder;

class RoutesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('routes')->delete();
        
        \DB::table('routes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => '用户列表页面',
                'method' => 'GET',
                'uri' => 'admin/users',
                'group' => '用户管理',
                'created_at' => '2016-10-12 16:08:55',
                'updated_at' => '2016-10-20 15:44:41',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => '后台首页',
                'method' => 'GET',
                'uri' => 'admin',
                'group' => '基本权限',
                'created_at' => '2016-10-12 16:09:34',
                'updated_at' => '2016-10-12 16:09:34',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => '用户添加页面',
                'method' => 'GET',
                'uri' => 'admin/users/create',
                'group' => '用户管理',
                'created_at' => '2016-10-12 16:10:22',
                'updated_at' => '2016-10-20 15:44:53',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => '权限添加页面',
                'method' => 'GET',
                'uri' => 'admin/routes/create',
                'group' => '',
                'created_at' => '2016-10-12 16:10:22',
                'updated_at' => '2016-10-12 16:10:22',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => '权限添加操作',
                'method' => 'POST',
                'uri' => 'admin/routes',
                'group' => '',
                'created_at' => '2016-10-12 16:10:22',
                'updated_at' => '2016-10-12 16:10:22',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => '菜单列表页面',
                'method' => 'GET',
                'uri' => 'admin/menus',
                'group' => '菜单管理',
                'created_at' => '2016-10-13 11:47:10',
                'updated_at' => '2016-10-13 11:47:10',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => '权限列表页面',
                'method' => 'GET',
                'uri' => 'admin/routes',
                'group' => '权限管理',
                'created_at' => '2016-10-13 11:47:56',
                'updated_at' => '2016-10-13 11:47:56',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => '权限设置页面',
                'method' => 'GET',
                'uri' => 'admin/routes/{routes}/roles',
                'group' => '权限管理',
                'created_at' => '2016-10-13 11:47:10',
                'updated_at' => '2016-10-13 11:47:10',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => '权限设置操作',
                'method' => 'POST',
                'uri' => 'admin/routes/{routes}/roles',
                'group' => '权限管理',
                'created_at' => '2016-10-13 12:20:17',
                'updated_at' => '2016-10-13 12:20:17',
            ),
            9 => 
            array (
                'id' => 19,
                'name' => '菜单删除操作',
                'method' => 'DELETE',
                'uri' => 'admin/menus/{menus}',
                'group' => '菜单管理',
                'created_at' => '2016-10-13 13:48:34',
                'updated_at' => '2016-10-13 13:48:34',
            ),
            10 => 
            array (
                'id' => 20,
                'name' => '菜单修改页面',
                'method' => 'GET',
                'uri' => 'admin/menus/{menus}/edit',
                'group' => '菜单管理',
                'created_at' => '2016-10-13 13:56:58',
                'updated_at' => '2016-10-13 13:56:58',
            ),
            11 => 
            array (
                'id' => 21,
                'name' => '菜单添加页面',
                'method' => 'GET',
                'uri' => 'admin/menus/create',
                'group' => '菜单管理',
                'created_at' => '2016-10-13 15:06:51',
                'updated_at' => '2016-10-13 15:06:51',
            ),
            12 => 
            array (
                'id' => 22,
                'name' => '菜单添加操作',
                'method' => 'POST',
                'uri' => 'admin/menus',
                'group' => '菜单管理',
                'created_at' => '2016-10-13 15:07:24',
                'updated_at' => '2016-10-13 15:07:24',
            ),
            13 => 
            array (
                'id' => 24,
                'name' => '角色列表页面',
                'method' => 'GET',
                'uri' => 'admin/roles',
                'group' => '角色管理',
                'created_at' => '2016-10-13 22:00:57',
                'updated_at' => '2016-10-13 22:00:57',
            ),
            14 => 
            array (
                'id' => 25,
                'name' => '设置权限页面',
                'method' => 'GET',
                'uri' => 'admin/roles/{roles}/routes',
                'group' => '角色管理',
                'created_at' => '2016-10-14 10:32:39',
                'updated_at' => '2016-10-14 10:32:39',
            ),
            15 => 
            array (
                'id' => 26,
                'name' => '菜单角色页面',
                'method' => 'GET',
                'uri' => 'admin/menus/{menus}/roles',
                'group' => '菜单管理',
                'created_at' => '2016-10-14 10:52:47',
                'updated_at' => '2016-10-14 10:52:47',
            ),
            16 => 
            array (
                'id' => 27,
                'name' => '菜单角色设置操作',
                'method' => 'POST',
                'uri' => 'admin/menus/{menus}/roles',
                'group' => '菜单管理',
                'created_at' => '2016-10-14 10:53:20',
                'updated_at' => '2016-10-14 10:53:20',
            ),
            17 => 
            array (
                'id' => 29,
                'name' => '角色权限设置操作',
                'method' => 'POST',
                'uri' => 'admin/roles/{roles}/routes',
                'group' => '角色管理',
                'created_at' => '2016-10-14 11:08:18',
                'updated_at' => '2016-10-14 11:08:18',
            ),
            18 => 
            array (
                'id' => 30,
                'name' => '角色菜单设置页面',
                'method' => 'GET',
                'uri' => 'admin/roles/{roles}/menus',
                'group' => '角色管理',
                'created_at' => '2016-10-14 11:43:29',
                'updated_at' => '2016-10-14 11:43:29',
            ),
            19 => 
            array (
                'id' => 31,
                'name' => '角色菜单设置操作',
                'method' => 'POST',
                'uri' => 'admin/roles/{roles}/menus',
                'group' => '角色管理',
                'created_at' => '2016-10-14 11:44:01',
                'updated_at' => '2016-10-14 11:44:01',
            ),
            20 => 
            array (
                'id' => 32,
                'name' => '角色添加页面',
                'method' => 'GET',
                'uri' => 'admin/roles/create',
                'group' => '角色管理',
                'created_at' => '2016-10-14 17:52:43',
                'updated_at' => '2016-10-14 17:52:43',
            ),
            21 => 
            array (
                'id' => 34,
                'name' => '角色添加操作',
                'method' => 'POST',
                'uri' => 'admin/roles',
                'group' => '角色管理',
                'created_at' => '2016-10-14 17:55:10',
                'updated_at' => '2016-10-14 17:55:10',
            ),
            22 => 
            array (
                'id' => 36,
                'name' => '菜单编辑操作',
                'method' => 'PUT',
                'uri' => 'admin/menus/{menus}',
                'group' => '菜单管理',
                'created_at' => '2016-10-19 12:23:42',
                'updated_at' => '2016-10-19 12:23:42',
            ),
            23 => 
            array (
                'id' => 38,
                'name' => '权限编辑页面',
                'method' => 'GET',
                'uri' => 'admin/routes/{routes}/edit',
                'group' => '权限管理',
                'created_at' => '2016-10-19 15:23:19',
                'updated_at' => '2016-10-19 15:23:19',
            ),
            24 => 
            array (
                'id' => 39,
                'name' => '权限编辑操作',
                'method' => 'PUT',
                'uri' => 'admin/routes/{routes}',
                'group' => '权限管理',
                'created_at' => '2016-10-19 15:24:12',
                'updated_at' => '2016-10-19 15:24:12',
            ),
            25 => 
            array (
                'id' => 40,
                'name' => '权限删除操作',
                'method' => 'DELETE',
                'uri' => 'admin/routes/{routes}',
                'group' => '权限管理',
                'created_at' => '2016-10-19 16:28:31',
                'updated_at' => '2016-10-19 16:28:31',
            ),
            26 => 
            array (
                'id' => 41,
                'name' => '角色编辑页面',
                'method' => 'GET',
                'uri' => 'admin/roles/{roles}/edit',
                'group' => '角色管理',
                'created_at' => '2016-10-19 20:04:37',
                'updated_at' => '2016-10-19 20:04:37',
            ),
            27 => 
            array (
                'id' => 42,
                'name' => '角色编辑操作',
                'method' => 'PUT',
                'uri' => 'admin/roles/{roles}',
                'group' => '角色管理',
                'created_at' => '2016-10-19 20:06:12',
                'updated_at' => '2016-10-19 20:06:12',
            ),
            28 => 
            array (
                'id' => 43,
                'name' => '角色删除操作',
                'method' => 'DELETE',
                'uri' => 'admin/roles/{roles}',
                'group' => '角色管理',
                'created_at' => '2016-10-19 20:20:28',
                'updated_at' => '2016-10-19 20:20:28',
            ),
            29 => 
            array (
                'id' => 44,
                'name' => '用户添加操作',
                'method' => 'POST',
                'uri' => 'admin/users',
                'group' => '用户管理',
                'created_at' => '2016-10-20 17:03:02',
                'updated_at' => '2016-10-20 17:03:02',
            ),
            30 => 
            array (
                'id' => 45,
                'name' => '用户编辑页面',
                'method' => 'GET',
                'uri' => 'admin/users/{users}/edit',
                'group' => '用户管理',
                'created_at' => '2016-10-21 14:24:49',
                'updated_at' => '2016-10-21 14:24:49',
            ),
            31 => 
            array (
                'id' => 46,
                'name' => '用户编辑操作',
                'method' => 'PUT',
                'uri' => 'admin/users/{users}',
                'group' => '用户管理',
                'created_at' => '2016-10-21 14:26:14',
                'updated_at' => '2016-10-21 14:26:14',
            ),
        ));
        
        
    }
}
