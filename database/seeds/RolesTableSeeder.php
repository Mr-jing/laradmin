<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 11,
                'name' => 'CEO',
                'display_name' => NULL,
                'description' => '',
                'created_at' => '2016-10-04 17:42:00',
                'updated_at' => '2016-10-04 17:42:00',
            ),
            1 => 
            array (
                'id' => 12,
                'name' => 'CTO',
                'display_name' => NULL,
                'description' => '',
                'created_at' => '2016-10-04 17:42:09',
                'updated_at' => '2016-10-04 17:42:09',
            ),
            2 => 
            array (
                'id' => 13,
                'name' => 'COO',
                'display_name' => NULL,
                'description' => '',
                'created_at' => '2016-10-04 17:42:15',
                'updated_at' => '2016-10-04 17:42:15',
            ),
            3 => 
            array (
                'id' => 14,
                'name' => 'CAO',
                'display_name' => NULL,
                'description' => '首席艺术官',
                'created_at' => '2016-10-10 09:39:56',
                'updated_at' => '2016-10-10 09:44:36',
            ),
            4 => 
            array (
                'id' => 15,
                'name' => 'CPO',
                'display_name' => NULL,
                'description' => '首席产品官',
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            5 => 
            array (
                'id' => 16,
                'name' => 'UFO',
                'display_name' => NULL,
                'description' => '',
                'created_at' => '2016-10-19 17:15:06',
                'updated_at' => '2016-10-19 17:15:06',
            ),
        ));
        
        
    }
}
