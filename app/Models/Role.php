<?php
namespace App\Models;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    public function routes()
    {
        return $this->belongsToMany('App\Models\Route', 'role_route');
    }

    public function menus()
    {
        return $this->belongsToMany('App\Models\Menu', 'role_menu');
    }
}
