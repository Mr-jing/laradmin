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
    }
}
