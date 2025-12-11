<?php

namespace App\Http\Controllers;

use App\Models\Canvas;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard based on user role.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = auth()->user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        switch (strtolower($user->role)) {
            case 'admin':
                return view('admin.dashboard');
            case 'supervisor':
                return view('supervisor.dashboard');
            default:
                $canvases = Canvas::where('user_id', $user->id)
                    ->orderBy('updated_at', 'desc')
                    ->take(3)
                    ->get();

                // Get total canvases count
                $totalCanvases = Canvas::where('user_id', $user->id)->count();

                // Get canvases created in the last month for comparison
                $lastMonthCanvases = Canvas::where('user_id', $user->id)
                    ->where('created_at', '>=', now()->subMonth())
                    ->count();

                // Get total nano-ideas (background items)
                $totalNanoIdeas = Canvas::where('user_id', $user->id)
                    ->withCount('backgroundItems')
                    ->get()
                    ->sum('background_items_count');

                // Get nano-ideas added in the last week for comparison
                $lastWeekNanoIdeas = Canvas::where('user_id', $user->id)
                    ->whereHas('backgroundItems', function($query) {
                        $query->where('created_at', '>=', now()->subWeek());
                    })
                    ->count();

                return view('User.dashboard', compact('canvases', 'totalCanvases', 'lastMonthCanvases', 'totalNanoIdeas', 'lastWeekNanoIdeas')); // Using your custom user dashboard
        }
    }

    /**
     * Display the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function adminIndex()
    {
        return view('Admin.dashboard');
    }

    /**
     * Display the supervisor dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function supervisorIndex()
    {
        return view('supervisor.dashboard');
    }
}
