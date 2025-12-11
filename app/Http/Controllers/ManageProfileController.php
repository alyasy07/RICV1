<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;

class ManageProfileController extends Controller
{
    public function index()
    {
        // Get current authenticated user
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to access this page');
        }
        
        return view('profile.manageProfile', compact('user'));
    }
    
    public function update(Request $request)
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to access this page');
        }
        
        $userId = $user->userID;
        
        // Validation rules
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:user,email,' . $userId . ',userID'
            ],
            'password' => 'nullable|confirmed|min:8',
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Please enter a valid email address',
            'email.unique' => 'This email is already in use',
            'password.min' => 'Password must be at least 8 characters',
            'password.confirmed' => 'Password confirmation does not match'
        ]);
        
        $updateData = [
            'username' => $request->name,
            'email' => $request->email,
            'updated_at' => now()
        ];
        
        // Handle password update
        if ($request->filled('password')) {
            $updateData['password'] = $request->password; // Model mutator will hash it
        }
        
        // Update user profile using Eloquent
        $user->fill($updateData);
        $user->save();
        
        if ($request->filled('password')) {
            return redirect()->route('manageProfile')
                ->with('success', 'Profile and password updated successfully!');
        } else {
            return redirect()->route('manageProfile')
                ->with('success', 'Profile updated successfully!');
        }
    }
}
