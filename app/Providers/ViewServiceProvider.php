<?php

namespace App\Providers;

use App\Models\Menu;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('admin.layout.sidebar', function (View $view) {
            // 当前后台用户
            $user = Auth::user();

            // 用户的所有角色（目前是单角色）
            $roles = $user->roles;

            // 当前用户可显示的菜单 id
            $checkedMenuIds = [];
            foreach ($roles as $role) {
                foreach ($role->menus as $menu) {
                    $checkedMenuIds[] = $menu->id;
                }
            }
            $checkedMenuIds = array_unique($checkedMenuIds);

            // 所有可显示的后台菜单
            $menus = Menu::where('status', '1')
                ->orderBy('sort', 'DESC')
                ->get()
                ->toArray();
            foreach ($menus as &$menu) {
                $menu['is_show'] = in_array($menu['id'], $checkedMenuIds);
            }

            $systemMenus = Menu::unlimited($menus);

            // 目前最多二级菜单
            foreach ($systemMenus as $k => &$menu) {
                foreach ($menu['children'] as $key => $subMenu) {
                    if (!$subMenu['is_show']) {
                        unset($menu['children'][$key]);
                    }
                }
                if (0 === count($menu['children'])) {
                    unset($systemMenus[$k]);
                }
            }
            $view->with('systemMenus', $systemMenus);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
