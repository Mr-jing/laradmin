<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $table = 'routes';

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'role_route');
    }
}