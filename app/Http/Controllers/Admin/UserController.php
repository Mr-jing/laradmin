<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->paginate(1);
        return view('admin.user.index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        $roles = Role::all()->toArray();
        $roleOptions = ['' => '无'] + array_column($roles, 'name', 'id');
        return view('admin.user.create', [
            'roleOptions' => $roleOptions,
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        $role = Role::findOrFail($request->role_id);

        $user = DB::transaction(function () use ($request, $role) {
            $user = User::create([
                'name' => trim($request->name),
                'email' => trim($request->email),
                'password' => bcrypt($request->password),
            ]);

            $user->attachRole($role);

            return $user;
        });

        return redirect()->route('admin.users.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $roles = Role::all()->toArray();
        $roleOptions = ['' => '无'] + array_column($roles, 'name', 'id');
        return view('admin.user.edit', [
            'roleOptions' => $roleOptions,
        ]);
    }

    public function update(StoreUserRequest $request, $id)
    {
        $role = Role::findOrFail($request->role_id);

        $user = DB::transaction(function () use ($request, $role) {
            $user = User::create([
                'name' => trim($request->name),
                'email' => trim($request->email),
                'password' => bcrypt($request->password),
            ]);

            $user->attachRole($role);

            return $user;
        });

        return redirect()->route('admin.users.index');
    }

    public function destroy($id)
    {
        //
    }
}
