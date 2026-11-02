<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->intended('/');
        }

        return back()->withErrors(['email' => 'อีเมลหรือรหัสผ่านไม่ถูกต้อง']);
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:100',
            'email'     => 'required|email|unique:users,email',
            'phone'     => ['required', 'regex:/^0[0-9]{9}$/'],
            'address'   => 'required|string',
            'password'  => 'required|confirmed|min:6',
        ]);

        $user = User::create([
            'full_name'     => $validated['full_name'],
            'email'         => $validated['email'],
            'phone'         => $validated['phone'],
            'address'       => $validated['address'],
            'password_hash' => Hash::make($validated['password']),
            'role'          => 'customer',
        ]);

        Auth::login($user);
        return redirect()->route('login')->with('success', 'สมัครสมาชิกสำเร็จ!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
