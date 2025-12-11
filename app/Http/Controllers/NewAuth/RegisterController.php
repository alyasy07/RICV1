<?php

namespace App\Http\Controllers\NewAuth;

use App\Http\Controllers\Controller;
use App\Models\NewUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('new_auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','email','max:255','unique:new_users,email'],
            'password' => ['required','confirmed','min:8'],
        ]);

        $user = NewUser::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::guard('newweb')->login($user);

        return redirect('/');
    }
}
