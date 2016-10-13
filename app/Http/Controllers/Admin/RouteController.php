<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateRouteRequest;
use App\Http\Requests\SetRoleIdsRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Route;
use App\Models\Role;

class RouteController extends Controller
{
    public function index()
    {
        $routes = Route::orderBy('uri', 'asc')->get()
            ->groupBy('group');

        return view('admin.route.index', [
            'routeGroups' => $routes
        ]);
    }

    public function create()
    {
        return view('admin.route.create');
    }

    public function store(CreateRouteRequest $request)
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
        return redirect()->action('Admin\RouteController@show', ['id' => $route->id]);
    }

    public function show($id)
    {
        $route = Route::findOrFail($id);

        $allRoles = Role::all()->toArray();

        $checkedRoleIds = $route->roles()->get()->modelKeys();

        return view('admin.route.show', [
            'allRoles' => $allRoles,
            'checkedRoleIds' => $checkedRoleIds,
            'routeId' => $id,
        ]);
    }

    public function postSetting(SetRoleIdsRequest $request, $id)
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

    public function update(Request $request, $id)
    {
        $route = Route::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'route_display_name' => 'required|max:255',
            'route_method' => 'required|max:20|in:GET,POST,PUT,DELETE',
            'route_uri' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator->errors());
        }
        $route->display_name = trim($request->route_display_name);
        $route->method = $request->route_method;
        $route->uri = trim($request->route_uri);
        $re = $route->save();
        if (!$re) {
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
        // 删除权限和角色的关联数据
        $route->roles()->detach();
        // 删除权限
        $route->delete();
        return response()->json([
            'status' => true,
            'msg' => '删除成功',
            'data' => array()
        ]);
    }
}
