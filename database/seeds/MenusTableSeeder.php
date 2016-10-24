<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('menus')->delete();
        
        \DB::table('menus')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => '权限管理',
                'url' => '',
                'parent_id' => 0,
                'sort' => 0,
                'status' => 1,
                'created_at' => '2016-09-29 21:19:04',
                'updated_at' => '2016-10-19 12:27:53',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => '菜单管理',
                'url' => 'admin/menus',
                'parent_id' => 1,
                'sort' => 300,
                'status' => 1,
                'created_at' => '2016-09-29 21:28:48',
                'updated_at' => '2016-10-19 12:44:05',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => '访问控制',
                'url' => 'admin/routes',
                'parent_id' => 1,
                'sort' => 0,
                'status' => 1,
                'created_at' => '2016-09-29 21:30:58',
                'updated_at' => '2016-09-29 21:30:58',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => '角色管理',
                'url' => 'admin/roles',
                'parent_id' => 1,
                'sort' => 0,
                'status' => 1,
                'created_at' => '2016-09-29 21:31:47',
                'updated_at' => '2016-09-29 21:31:47',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => '用户管理',
                'url' => '',
                'parent_id' => 0,
                'sort' => 0,
                'status' => 1,
                'created_at' => '2016-10-11 16:31:45',
                'updated_at' => '2016-10-11 16:31:45',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => '用户管理',
                'url' => 'admin/users',
                'parent_id' => 5,
                'sort' => 0,
                'status' => 1,
                'created_at' => '2016-10-11 17:28:34',
                'updated_at' => '2016-10-19 12:31:09',
            ),
        ));
        
        
    }
}
