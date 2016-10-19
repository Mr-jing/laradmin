<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\SetRoleIdsRequest;
use App\Models\Menu;
use App\Models\Role;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::orderBy('sort', 'DESC')
            ->get()
            ->toArray();
        return view('admin.menu.index', [
            'menus' => Menu::unlimitedForLevel($menus, 0, '------'),
        ]);
    }

    public function create()
    {
        $menus = Menu::orderBy('sort', 'DESC')
            ->select('id', 'name')
            ->where('parent_id', 0)
            ->get()
            ->toArray();

        $menuOptions = array(0 => '无') + array_column($menus, 'name', 'id');
        return view('admin.menu.create', [
            'menuOptions' => $menuOptions
        ]);
    }

    public function store(StoreMenuRequest $request)
    {
        if ('0' === $request->get('menu_parent_id')) {
            $parentId = 0;
        } else {
            $parentMenu = Menu::findOrFail($request->get('menu_parent_id'));
            $parentId = $parentMenu->id;
        }

        $menu = new Menu();
        $menu->name = trim($request->menu_name);
        $menu->url = $request->has('menu_url') ? trim($request->menu_url) : '';
        $menu->parent_id = $parentId;
        $menu->sort = '0';
        $menu->status = '1';
        if (!$menu->save()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(array('保存失败，请刷新页面后重试'));
        }
        return redirect()->action('Admin\MenuController@getRoles', ['id' => $menu->id]);
    }

    public function getRoles($id)
    {
        $menu = Menu::findOrFail($id);

        $allRoles = Role::all()->toArray();

        $checkedRoleIds = $menu->roles()->get()->modelKeys();
        foreach ($allRoles as &$role) {
            $role['checked'] = in_array($role['id'], $checkedRoleIds, true);
        }

        return view('admin.menu.roles', [
            'menu' => $menu,
            'roles' => $allRoles,
        ]);
    }

    public function postRoles(SetRoleIdsRequest $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $roleIds = array_unique($request->role_ids);
        $newRoles = empty($roleIds) ? array() : Role::whereIn('id', $roleIds)->get();

        DB::transaction(function () use ($menu, $newRoles) {
            // 删除所有
            $menu->roles()->detach();

            // 重新添加
            $menu->roles()->saveMany($newRoles);

        });
        return response()->json([
            'status' => true,
            'msg' => '设置成功',
            'data' => array(
                'url' => route('admin.menus.index'),
            )
        ]);
    }

    public function edit($id)
    {
        $menus = Menu::orderBy('sort', 'DESC')
            ->select('id', 'name')
            ->where('parent_id', 0)
            ->get()
            ->toArray();

        $menuOptions = array(0 => '无') + array_column($menus, 'name', 'id');

        $menu = Menu::findOrFail($id);
        return view('admin.menu.edit', [
            'menu' => $menu,
            'menuOptions' => $menuOptions,
        ]);
    }

    public function update(StoreMenuRequest $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $menu->name = trim($request->menu_name);
        $menu->url = $request->has('menu_url') ? trim($request->menu_url) : '';
        $menu->parent_id = $request->menu_parent_id;
        $menu->sort = $request->menu_sort;
        if (!$menu->save()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(array('保存失败，请刷新页面后重试'));
        }
        return redirect()->route('admin.menus.index');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);

        if ($menu->delete()) {
            return response()->json([
                'status' => true,
                'msg' => '删除成功',
                'data' => array()
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => '删除失败，请刷新页面后重新尝试',
                'data' => array()
            ]);
        }
    }
}
