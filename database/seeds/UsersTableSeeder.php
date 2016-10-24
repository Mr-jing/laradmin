<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'xj',
                'email' => 'admin@imojie.com',
                'password' => '$2y$10$Ord84jjX3BQgODhBOcXDFOmeQtfYYQqMxIvHiUH85iBM6VXE4yqvK',
                'remember_token' => 'OpwFQYOQvmormNtvZ8K5cVoWkHOyPKNXfLAsMNROck7MtptoOcC83dT0DXO6',
                'created_at' => '2016-10-12 21:24:40',
                'updated_at' => '2016-10-21 15:14:09',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'test1',
                'email' => 'test1@q.com',
                'password' => '$2y$10$Vm1/oS/TS5joPXw22eHWROlInbWpJ9iJTTUcTu.sqYeaCcKNPC22W',
                'remember_token' => 'U7DaVumCjtkqIfqLyzP6K5XQSGXn0W67q5OOQlqNVsgL6EOV9Bqvwr0T9Upr',
                'created_at' => '2016-10-19 20:17:46',
                'updated_at' => '2016-10-19 20:18:43',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'test2',
                'email' => 'test2@q.com',
                'password' => '123456',
                'remember_token' => NULL,
                'created_at' => '2016-10-20 21:45:19',
                'updated_at' => '2016-10-20 21:45:19',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'test3',
                'email' => 'test3@q.com',
                'password' => '$2y$10$0Xbs7bHcyRQ97Y.D8msNwe30R.ts/LzJKDES6KXZwMB990NgpAZQ6',
                'remember_token' => NULL,
                'created_at' => '2016-10-20 22:20:38',
                'updated_at' => '2016-10-20 22:20:38',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'test6',
                'email' => 'test6@q.com',
                'password' => '$2y$10$Scx2xh59Rt4JWixPa2.OWOC.plCIFT3PsdSzUDXkMfpUighN6DeQe',
                'remember_token' => NULL,
                'created_at' => '2016-10-20 22:24:03',
                'updated_at' => '2016-10-21 14:46:09',
            ),
        ));
        
        
    }
}
