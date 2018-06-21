<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DefaultController extends Controller
{
    public function index()
    {
        if (\Auth::guard('admin')->check()) {
            return redirect(route('admin.home.index'));
        } else {
            return redirect(route('admin.login'));
        }
    }

    public function login(Request $request)
    {
        if ($request->isMethod('get')) {
            return admin_view('login');
        }

        $name = $request->name;
        $password = $request->password;

        if (empty($name) || empty($password)) {
            return renderJS('管理员账号或者密码不能为空', route('admin.loginform'));
        }

        if (! Auth::guard('admin')->attempt(['admin' => $name, 'password' => $password])) {
            return renderJS('管理员账号与密码不匹配', route('admin.loginform'));
        }

        return redirect(admin_url('home'));
    }

}