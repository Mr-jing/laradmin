<?php

use Illuminate\Database\Seeder;

class RoleMenuTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('role_menu')->delete();
        
        \DB::table('role_menu')->insert(array (
            0 => 
            array (
                'role_id' => 11,
                'menu_id' => 1,
            ),
            1 => 
            array (
                'role_id' => 15,
                'menu_id' => 1,
            ),
            2 => 
            array (
                'role_id' => 11,
                'menu_id' => 2,
            ),
            3 => 
            array (
                'role_id' => 12,
                'menu_id' => 2,
            ),
            4 => 
            array (
                'role_id' => 13,
                'menu_id' => 2,
            ),
            5 => 
            array (
                'role_id' => 14,
                'menu_id' => 2,
            ),
            6 => 
            array (
                'role_id' => 15,
                'menu_id' => 2,
            ),
            7 => 
            array (
                'role_id' => 11,
                'menu_id' => 3,
            ),
            8 => 
            array (
                'role_id' => 15,
                'menu_id' => 3,
            ),
            9 => 
            array (
                'role_id' => 11,
                'menu_id' => 4,
            ),
            10 => 
            array (
                'role_id' => 12,
                'menu_id' => 4,
            ),
            11 => 
            array (
                'role_id' => 13,
                'menu_id' => 4,
            ),
            12 => 
            array (
                'role_id' => 14,
                'menu_id' => 4,
            ),
            13 => 
            array (
                'role_id' => 15,
                'menu_id' => 4,
            ),
            14 => 
            array (
                'role_id' => 11,
                'menu_id' => 5,
            ),
            15 => 
            array (
                'role_id' => 12,
                'menu_id' => 5,
            ),
            16 => 
            array (
                'role_id' => 13,
                'menu_id' => 5,
            ),
            17 => 
            array (
                'role_id' => 14,
                'menu_id' => 5,
            ),
            18 => 
            array (
                'role_id' => 15,
                'menu_id' => 5,
            ),
            19 => 
            array (
                'role_id' => 11,
                'menu_id' => 6,
            ),
            20 => 
            array (
                'role_id' => 12,
                'menu_id' => 6,
            ),
            21 => 
            array (
                'role_id' => 13,
                'menu_id' => 6,
            ),
        ));
        
        
    }
}
