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


class LoginController extends Controller
{
    public function create()
    {
        return view('admin.auth.login');
    }
 
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
    
        $credentials = $request->only('username', 'password');
        
        if (Auth::guard('admin')->attempt($credentials)) {
            // Login berhasil
            return redirect()->intended('admin/dashboard');
        }

        \Log::info($credentials);
    
        // Login gagal
        return redirect()->back()->withErrors([
            'login_error' => 'Username atau password salah.',
        ]);
    }

    public function destroy(Request $request)
    {
        Auth::guard('admin')->logout(); // Logout dari guard admin

        $request->session()->invalidate(); // Menghapus session yang ada
        $request->session()->regenerateToken(); // Membuat token baru untuk keamanan

        return redirect()->route('admin.login'); // Redirect ke halaman login
    }

}