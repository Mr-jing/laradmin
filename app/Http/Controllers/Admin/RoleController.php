<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Http\Requests\CreateRoleRequest;

use App\Http\Controllers\Controller;

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

    public function store(CreateRoleRequest $request)
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

    public function show($id)
    {
        $role = Role::findOrFail($id);
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.role.edit', [
            'role' => $role
        ]);
    }

    public function update(CreateRoleRequest $request, $id)
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
        $count = $role->users()->count();
        if ($count > 0) {
            return response()->json([
                'status' => false,
                'msg' => '该角色已被赋予用户，无法删除',
                'data' => array()
            ]);
        }
        if ($role->delete()) {
            // TODO 删除 role_user、role_menu、role_route、permission_role 的记录
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
        $selectedRouteIds = array_column($role->routes->toArray(), 'id');
        foreach ($allRoutes as &$route) {
            $route['selected'] = in_array($route['id'], $selectedRouteIds);
        }
        return view('admin.role.routes', [
            'role' => $role,
            'routes' => $allRoutes,
        ]);
    }

    public function postRoutes(Request $request, $id)
    {
        // 获取角色
        $role = Role::findOrFail($id);
        // 验证提交的参数
        $validator = Validator::make($request->all(), [
            'route_ids' => 'array',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false,
                'info' => $validator->errors()->first(),
                'data' => array()]);
        }
        // 先删除该角色所拥有的 route 权限
        $count = $role->routes()->detach();
        if (!is_numeric($count)) {
            return response()->json(['status' => false,
                'info' => '删除权限失败，请刷新后重试',
                'data' => array()]);
        }
        $successRes = ['status' => true,
            'info' => '设置成功',
            'data' => array(
                'url' => route('admin.roles.index'),
            )];
        if (empty($request->route_ids) || !is_array($request->route_ids)) {
            return response()->json($successRes);
        }
        // 为角色添加 route 权限
        $routeIds = array_unique($request->route_ids);
        $routes = [];
        foreach ($routeIds as $routeId) {
            if ($route = Route::find($routeId)) {
                $routes[] = $route;
            }
        }
        $role->routes()->saveMany($routes);
        return response()->json($successRes);
    }

    public function getMenus($id)
    {
        $role = Role::findOrFail($id);
        $allMenus = Menu::where('level', '<=', 2)
            ->orderBy('sort', 'DESC')
            ->get()
            ->toArray();
        $selectedMenusIds = array_column($role->menus->toArray(), 'id');
        foreach ($allMenus as &$menu) {
            $menu['selected'] = in_array($menu['id'], $selectedMenusIds);
        }
        return view('admin.role.menus', [
            'role' => $role,
            'menus' => Menu::unlimitedForLayer($allMenus),
        ]);
    }

    public function postMenus(Request $request, $id)
    {
        // 获取角色
        $role = Role::findOrFail($id);
        // 验证提交的参数
        $validator = Validator::make($request->all(), [
            'menu_ids' => 'array',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'msg' => $validator->errors()->first(),
                'data' => array()
            ]);
        }
        // 先删除该角色所拥有的菜单显示权限
        $count = $role->menus()->detach();
        if (!is_numeric($count)) {
            return response()->json([
                'status' => false,
                'msg' => '删除失败，请刷新后重试',
                'data' => array()
            ]);
        }
        $successRes = ['status' => true,
            'msg' => '设置成功',
            'data' => array(
                'url' => route('admin.roles.index'),
            )];
        if (empty($request->menu_ids) || !is_array($request->menu_ids)) {
            return response()->json($successRes);
        }
        // 为角色添加菜单显示权限
        $menuIds = array_unique($request->menu_ids);
        $menus = [];
        foreach ($menuIds as $menuId) {
            if ($menu = Menu::find($menuId)) {
                $menus[] = $menu;
            }
        }
        $role->menus()->saveMany($menus);
        return response()->json($successRes);
    }
}
