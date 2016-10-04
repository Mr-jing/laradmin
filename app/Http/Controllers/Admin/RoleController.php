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
}
