<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\NewUser;
use App\Models\Canvas;

class WelcomeController extends Controller
{
    public function index()
    {
        // If user is authenticated, redirect based on role. If not, show welcome page.
        if (auth()->check()) {
            return auth()->user()->role === 'admin'
                ? redirect()->route('admin.dashboard')
                : redirect()->route('dashboard');
        }
        
        // Get statistics for the welcome page
        $totalUsers = User::count();
        $totalCanvases = Canvas::count();

        return view('welcome', compact('totalUsers', 'totalCanvases'));
    }
}