<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Surf_Users;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'Username' => 'required|string|max:255|unique:surf_users',
            'Password' => 'required|string|min:8|confirmed',
        ]);

        Surf_Users::create([
            'Username' => $request->Username,
            'Password' => Hash::make($request->Password),
            'Role' => 'user',
        ]);

        return redirect()->route('index')->with('success', 'Registration successful. Please login.');
    }


    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('Username', 'Password');

        \Log::info('Login attempt', ['username' => $credentials['Username'], 'password' => $credentials['Password']]);

        $user = Surf_Users::where('Username', $credentials['Username'])->first();

        if ($user && Hash::check($credentials['Password'], $user->Password)) {
            Auth::login($user);
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'Username' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('index');
    }
}



