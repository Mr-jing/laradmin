<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->paginate(3);
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
        $user = User::findOrFail($id);

        $roles = Role::all()->toArray();
        $roleOptions = ['' => '无'] + array_column($roles, 'name', 'id');

        return view('admin.user.edit', [
            'user' => $user,
            'roleOptions' => $roleOptions,
        ]);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $role = Role::findOrFail($request->role_id);

        $user->name = trim($request->name);
        $user->email = trim($request->email);
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        DB::transaction(function () use ($user, $role) {
            if ($user->save()) {
                $user->roles()->detach();
                $user->attachRole($role);
            }
        });

        return redirect()->route('admin.users.index');
    }

    public function destroy($id)
    {
        //
    }
}
