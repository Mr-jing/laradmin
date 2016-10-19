<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreRouteRequest;
use App\Http\Requests\SetRoleIdsRequest;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Route;
use App\Models\Role;

class RouteController extends Controller
{
    public function index()
    {
        $routes = Route::orderBy('uri', 'asc')->get();
        return view('admin.route.index', [
            'routes' => $routes
        ]);
    }

    public function create()
    {
        return view('admin.route.create');
    }

    public function store(StoreRouteRequest $request)
    {
        $route = new Route();
        $route->name = trim($request->route_name);
        $route->method = $request->route_method;
        $route->uri = trim($request->route_uri);
        $route->group = $request->has('route_group') ? trim($request->route_group) : '';

        try {
            $status = $route->save();
        } catch (QueryException $e) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(array('该权限已存在，请勿重复添加'));
        }

        if (!$status) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(array('保存失败，请刷新页面后重试'));
        }
        return redirect()->action('Admin\RouteController@getRoles', [$route->id]);
    }

    public function getRoles($id)
    {
        $route = Route::findOrFail($id);

        $allRoles = Role::all()->toArray();

        $checkedRoleIds = $route->roles()->get()->modelKeys();
        foreach ($allRoles as &$role) {
            $role['checked'] = in_array($role['id'], $checkedRoleIds, true);
        }

        return view('admin.route.roles', [
            'route' => $route,
            'roles' => $allRoles,
        ]);
    }

    public function postRoles(SetRoleIdsRequest $request, $id)
    {
        $route = Route::findOrFail($id);

        $roleIds = array_unique($request->role_ids);
        $newRoles = empty($roleIds) ? array() : Role::whereIn('id', $roleIds)->get();

        DB::transaction(function () use ($route, $newRoles) {
            // 删除所有
            $route->roles()->detach();

            // 重新添加
            $route->roles()->saveMany($newRoles);

        });

        return response()->json([
            'status' => true,
            'msg' => '设置成功',
            'data' => array(
                'url' => route('admin.routes.index'),
            )
        ]);
    }

    public function edit($id)
    {
        $route = Route::findOrFail($id);
        return view('admin.route.edit', [
            'route' => $route,
        ]);
    }

    public function update(StoreRouteRequest $request, $id)
    {
        $route = Route::findOrFail($id);

        $route->name = trim($request->route_name);
        $route->method = $request->route_method;
        $route->uri = trim($request->route_uri);
        $route->group = $request->has('route_group') ? trim($request->route_group) : '';

        try {
            $status = $route->save();
        } catch (QueryException $e) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(array('该权限已存在，请勿重复添加'));
        }

        if (!$status) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(array('保存失败，请刷新页面后重试'));
        }

        return redirect()->route('admin.routes.index');
    }

    public function destroy($id)
    {
        $route = Route::findOrFail($id);

        if ($route->delete()) {
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
