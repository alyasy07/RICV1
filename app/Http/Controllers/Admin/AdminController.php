<?php
    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use App\Models\NewUser;
    use App\Models\Canvas;
    use App\Models\Reference;
    use Illuminate\Http\Request;

    class AdminController extends Controller
    {
        public function allRecentCanvases()
        {
            $search = request()->query('search');
            $query = Canvas::with(['user', 'backgroundItems', 'flows'])
                ->whereHas('user', function($query) {
                    $query->where('role', 'user');
                });
            if ($search) {
                $query->where('research_working_title', 'like', "%$search%");
            }
            $recentCanvases = $query->latest()->paginate(10);
            return view('admin.recent_canvases', compact('recentCanvases', 'search'));
        }
    public function dashboard()
    {
        $currentAdmin = auth()->user();
        
        // Admin's own statistics
        $adminStats = [
            'my_canvases' => Canvas::where('user_id', $currentAdmin->id)->count(),
            'my_nano_ideas' => Canvas::where('user_id', $currentAdmin->id)
                ->withCount('backgroundItems')
                ->get()
                ->sum('background_items_count'),
            'my_micro_ideas' => Canvas::where('user_id', $currentAdmin->id)
                ->withCount('flows')
                ->get()
                ->sum('flows_count'),
            'my_recent_canvas' => Canvas::where('user_id', $currentAdmin->id)
                ->latest()
                ->first(),
        ];
        
        // System-wide statistics for all users
        $systemStats = [
            'total_users' => NewUser::where('role', 'user')->count(),
            'total_canvases' => Canvas::count(),
            'total_references' => Reference::count(),
            'canvases_this_month' => Canvas::whereMonth('created_at', now()->month)->count(),
            'total_nano_ideas' => Canvas::withCount('backgroundItems')->get()->sum('background_items_count'),
            'total_micro_ideas' => Canvas::withCount('flows')->get()->sum('flows_count'),
        ];

        // Recent canvases from all users (excluding admin)
        $viewAll = request()->query('view') === 'all';
        $recentCanvasesQuery = Canvas::with(['user', 'backgroundItems', 'flows'])
            ->whereHas('user', function($query) {
                $query->where('role', 'user');
            })
            ->latest();
        $recentCanvases = $viewAll
            ? $recentCanvasesQuery->take(10)->get()
            : $recentCanvasesQuery->take(3)->get();

        // Top users by canvas count
        $topUsers = NewUser::where('role', 'user')
            ->withCount('canvases')
            ->orderBy('canvases_count', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('adminStats', 'systemStats', 'recentCanvases', 'topUsers'));
    }
}
