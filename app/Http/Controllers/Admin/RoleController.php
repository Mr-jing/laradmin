<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\SetMenuIdsRequest;
use App\Http\Requests\SetRouteIdsRequest;
use App\Models\Menu;
use App\Models\Role;
use App\Models\Route;

class RoleController extends Controller
{
    public function index()
    {
        return view('admin.role.index', [
            'roles' => Role::orderBy('id', 'desc')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.role.create');
    }

    public function store(StoreRoleRequest $request)
    {
        $role = new Role();
        $role->name = trim($request->role_name);
        $role->description = trim($request->role_description);
        // TODO try
        if (!$role->save()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(array('保存失败，请刷新页面后重试'));
        }
        return redirect()->route('admin.roles.index');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.role.edit', [
            'role' => $role
        ]);
    }

    public function update(StoreRoleRequest $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->name = trim($request->role_name);
        $role->description = trim($request->role_description);
        if (!$role->save()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(array('保存失败，请刷新页面后重试'));
        }
        return redirect()->route('admin.roles.index');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        if ($role->users()->count() > 0) {
            return response()->json([
                'status' => false,
                'msg' => '该角色已被赋予用户，无法删除',
                'data' => array()
            ]);
        }

        if ($role->delete()) {
            return response()->json([
                'status' => true,
                'msg' => '删除成功',
                'data' => array()
            ]);
        }

        return response()->json([
            'status' => false,
            'msg' => '删除失败，请刷新后重试',
            'data' => array()
        ]);
    }

    public function getRoutes($id)
    {
        $role = Role::findOrFail($id);
        $allRoutes = Route::orderBy('uri', 'asc')->get()->toArray();
        $checkedRouteIds = array_column($role->routes->toArray(), 'id');
        foreach ($allRoutes as &$route) {
            $route['checked'] = in_array($route['id'], $checkedRouteIds, true);
        }
        return view('admin.role.routes', [
            'role' => $role,
            'routes' => $allRoutes,
        ]);
    }

    public function postRoutes(SetRouteIdsRequest $request, $id)
    {
        // 获取角色
        $role = Role::findOrFail($id);

        $routeIds = array_unique($request->route_ids);
        $newRoutes = empty($routeIds) ? array() : Route::whereIn('id', $routeIds)->get();

        DB::transaction(function () use ($role, $newRoutes) {
            // 删除所有
            $role->routes()->detach();

            // 重新添加
            $role->routes()->saveMany($newRoutes);
        });

        return response()->json([
            'status' => true,
            'msg' => '设置成功',
            'data' => array(
                'url' => route('admin.roles.index'),
            )
        ]);
    }

    public function getMenus($id)
    {
        $role = Role::findOrFail($id);
        $allMenus = Menu::orderBy('sort', 'DESC')->get()->toArray();

        $checkedMenusIds = array_column($role->menus->toArray(), 'id');
        foreach ($allMenus as &$menu) {
            $menu['checked'] = in_array($menu['id'], $checkedMenusIds);
        }

        return view('admin.role.menus', [
            'role' => $role,
            'menus' => Menu::unlimitedForLevel($allMenus, 0, '----'),
        ]);
    }

    public function postMenus(SetMenuIdsRequest $request, $id)
    {
        // 获取角色
        $role = Role::findOrFail($id);

        $menuIds = array_unique($request->menu_ids);
        $newMenus = empty($menuIds) ? array() : Menu::whereIn('id', $menuIds)->get();

        DB::transaction(function () use ($role, $newMenus) {
            // 删除所有
            $role->menus()->detach();

            // 重新添加
            $role->menus()->saveMany($newMenus);
        });

        return response()->json([
            'status' => true,
            'msg' => '设置成功',
            'data' => array(
                'url' => route('admin.roles.index'),
            )
        ]);
    }
}
