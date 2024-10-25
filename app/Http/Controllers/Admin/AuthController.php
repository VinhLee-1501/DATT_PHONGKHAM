<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('System.auth.login');
    }

    public function handleLogin(Request $request)
    {
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role == 1 ||$user-> role == 2) {
                $request->session()->regenerate();
                session(['user_data' => $user]);

                return redirect()->route('system.dashboard')->with('success', 'Đăng nhập thành công');
            } else {
                Auth::logout();
                return redirect()->back()->with('warning', 'Tài khoản thành viên không có quyền truy cập. Cố ý truy cập sẽ bị khóa tài khoản');
            }
        }

        return redirect()->back()->with('error', 'Thông tin đăng nhập không chính xác');
    }

    public function logout(Request $request)
    {
        if (Auth::user()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('system.auth.login')->with('success', 'Đăng xuất thành công');
        }
    }
}
