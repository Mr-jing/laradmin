<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public static function unlimitedForLevel($category, $parentId = 0, $prefix = '', $level = 1, $hasChildren = false)
    {
        $arr = array();
        foreach ($category as $v) {
            if ($v['parent_id'] == $parentId) {
                $v['prefix'] = str_repeat($prefix, $level - 1);
                $v['parent_id'] = $parentId;
                $v['level'] = $level;

                // 将子分类放在父级分类的子项中
                if ($hasChildren) {
                    $v['children'] = self::unlimitedForLevel($category, $v['id'], $prefix, $v['level'] + 1, $hasChildren);
                }

                $arr[] = $v;
                $arr = array_merge($arr, self::unlimitedForLevel($category, $v['id'], $prefix, $level + 1, $hasChildren));
            }
        }
        return $arr;
    }

    public static function unlimited($category, $keyName = 'children', $pid = 0)
    {
        $arr = array();
        foreach ($category as $v) {
            if ($v['parent_id'] == $pid) {
                $v[$keyName] = self::unlimited($category, $keyName, $v['id']);
                $arr[] = $v;
            }
        }
        return $arr;
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'role_menu');
    }
}
