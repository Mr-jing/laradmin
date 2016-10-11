<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use App\Models\Route;

class CheckRoleRoute
{
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next)
    {
        // 如果未登录，请先登录
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect('admin/auth/login');
            }
        } else {
            // 如果有访问权限，执行下一个中间件；否则，返回 403
            if ($this->canAccess($request->method(), $request->route()->getUri())) {
                return $next($request);
            } else {
                abort(403);
            }
        }
    }

    public function canAccess($method, $uri)
    {
        $route = Route::where('method', strtoupper($method))
            ->where('uri', $uri)
            ->first();
        if (!$route) {
            return false;
        }
        $roleNames = array_column($route->roles->toArray(), 'name');
        if (!$roleNames) {
            return false;
        }
        $user = $this->auth->user();
        return $user->hasRole($roleNames);
    }
}