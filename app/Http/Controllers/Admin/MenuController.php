<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SetRoleIdsRequest;
use Illuminate\Http\Request;

use App\Http\Requests\CreateMenuRequest;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::orderBy('sort', 'ASC')
            ->get()
            ->toArray();
        return view('admin.menu.index', [
            'menus' => Menu::unlimitedForLevel($menus, 0, '------'),
        ]);
    }

    public function create()
    {
        $menus = Menu::orderBy('sort', 'ASC')
            ->select('id', 'name')
            ->where('parent_id', 0)
            ->get()
            ->toArray();

        $menuOptions = array(0 => '无') + array_column($menus, 'name', 'id');
        return view('admin.menu.create', [
            'menuOptions' => $menuOptions
        ]);
    }

    public function store(CreateMenuRequest $request)
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
        $menu->status = '0';
        if (!$menu->save()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(array('保存失败，请刷新页面后重试'));
        }
        return redirect()->action('Admin\MenuController@show', ['id' => $menu->id]);
    }

    public function show($id)
    {
        $menu = Menu::findOrFail($id);

        $allRoles = Role::all()->toArray();

        $checkedRoleIds = $menu->roles()->get()->modelKeys();

        return view('admin.menu.show', [
            'allRoles' => $allRoles,
            'checkedRoleIds' => $checkedRoleIds,
            'menuId' => $id,
        ]);
    }

    public function postSetting(SetRoleIdsRequest $request, $id)
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
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
