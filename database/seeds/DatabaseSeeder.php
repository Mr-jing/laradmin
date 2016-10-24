<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call(UserTableSeeder::class);

        Model::reguard();
        $this->call('UsersTableSeeder');
        $this->call('RolesTableSeeder');
        $this->call('MenusTableSeeder');
        $this->call('RoutesTableSeeder');
        $this->call('RoleUserTableSeeder');
        $this->call('RoleMenuTableSeeder');
        $this->call('RoleRouteTableSeeder');
    }
}
