<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Requests\Auth\AdminLoginRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;


class UserLoginController extends Controller
{
    public function userCreate()
    {
        return view('admin.auth.user-login');
    }
 
    public function userStore(Request $request): RedirectResponse
    {
        // Validasi manual untuk mengatasi berbagai kondisi
        $messages = [];
        if (!$request->filled('username') && !$request->filled('password')) {
            $messages['login_error'] = 'Username dan Password tidak terisi.';
        } elseif (!$request->filled('username')) {
            $messages['login_error'] = 'Username tidak boleh kosong.';
        } elseif (!$request->filled('password')) {
            $messages['login_error'] = 'Password tidak boleh kosong.';
        }

        if (!empty($messages)) {
            return redirect()->back()->withErrors($messages);
        }

        // Jika validasi berhasil, lanjutkan dengan autentikasi
        $credentials = $request->only('username', 'password');
        
        if (Auth::guard('web')->attempt($credentials)) {
            // Login berhasil 
            return redirect()->intended('user-dashboard');
        } elseif (Auth::guard('admin')->attempt($credentials)) {
            // Login berhasil
            return redirect()->intended('dashboard');
        }

        // Login gagal
        return redirect()->back()->withErrors([
            'login_error' => 'Username atau Password salah.',
        ]);
    }

    public function userLogout(Request $request)
    {
        Auth::guard('web')->logout(); // Logout dari guard users
        Auth::guard('admin')->logout(); // Logout dari guard admin

        $request->session()->invalidate(); // Menghapus session yang ada
        $request->session()->regenerateToken(); // Membuat token baru untuk keamanan

        return redirect()->route('login'); // Redirect ke halaman login
    }
    

}