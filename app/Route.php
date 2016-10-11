<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $table = 'routes';

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }
}