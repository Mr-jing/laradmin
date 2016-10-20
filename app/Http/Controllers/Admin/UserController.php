<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
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
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
