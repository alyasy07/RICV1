<?php

namespace App\Http\Controllers\NewAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('new_auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('newweb')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Authentication failed for provided credentials.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('newweb')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('newauth.login');
    }
}
