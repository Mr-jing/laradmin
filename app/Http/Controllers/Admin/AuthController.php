<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    use AuthenticatesUsers, ThrottlesLogins;

    // 登录页面
    protected $loginPath = 'admin/auth/login';

    // 登录成功后跳转的地址
    protected $redirectPath = 'admin';

    // 退出成功后跳转的地址
    protected $redirectAfterLogout = 'admin/auth/login';

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function getLogin()
    {
        return view('admin.auth.login');
    }
}