@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/reference-theme.css') }}?v={{ time() }}" rel="stylesheet">
@endsection

@section('content')
@php
    use Illuminate\Support\Str;
    
    // Fallback for missing variables
    $adminStats = $adminStats ?? [
        'my_canvases' => 0,
        'my_nano_ideas' => 0,
        'my_micro_ideas' => 0,
        'my_recent_canvas' => null
    ];
    
    $systemStats = $systemStats ?? [
        'total_users' => 0,
        'total_canvases' => 0,
        'total_references' => 0,
        'canvases_this_month' => 0,
        'total_nano_ideas' => 0,
        'total_micro_ideas' => 0
    ];
    
    $recentCanvases = $recentCanvases ?? collect();
    $topUsers = $topUsers ?? collect();
@endphp

<div class="main-content">
    <!-- Hero Section with Gradient Background -->
    <div class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">Admin Dashboard</h1>
            <p class="hero-subtitle">Welcome back, {{ auth()->user()->name }}. Manage your research platform.</p>
        </div>
    </div>

    <div class="content-container">

    <!-- My Statistics Section -->
    <div class="content-section">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">My Statistics</h2>
                <p class="text-gray-600">Your personal research metrics and activity overview</p>
            </div>
            <div class="icon-container">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 00-2-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4" style="display: grid !important; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)) !important; gap: 1rem !important;">
            <!-- My Canvases -->
            <div class="modern-card">
                <div class="flex flex-col">
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-gray-500 text-sm font-medium">My Canvases</p>
                        <div class="p-2 rounded-full bg-blue-50">
                            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-4xl font-bold text-gray-900 mb-2">{{ $adminStats['my_canvases'] }}</p>
                    <p class="text-xs text-gray-400">Research canvases</p>
                </div>
            </div>

            <!-- My Nano Ideas -->
            <div class="modern-card">
                <div class="flex flex-col">
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-gray-500 text-sm font-medium">My Nano Ideas</p>
                        <div class="p-2 rounded-full bg-purple-50">
                            <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-4xl font-bold text-gray-900 mb-2">{{ $adminStats['my_nano_ideas'] }}</p>
                    <p class="text-xs text-gray-400">Quick research ideas</p>
                </div>
            </div>

            <!-- My Micro Ideas -->
            <div class="modern-card">
                <div class="flex flex-col">
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-gray-500 text-sm font-medium">My Micro Ideas</p>
                        <div class="p-2 rounded-full bg-green-50">
                            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-4xl font-bold text-gray-900 mb-2">{{ $adminStats['my_micro_ideas'] }}</p>
                    <p class="text-xs text-gray-400">Research concepts</p>
                </div>
            </div>

            <!-- My Last Activity -->
            <div class="modern-card">
                <div class="flex flex-col">
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-gray-500 text-sm font-medium">Last Activity</p>
                        <div class="p-2 rounded-full bg-orange-50">
                            <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    @if($adminStats['my_recent_canvas'])
                        <p class="text-lg font-bold text-gray-900 mb-1 truncate" title="{{ $adminStats['my_recent_canvas']->research_working_title }}">
                            {{ Str::limit($adminStats['my_recent_canvas']->research_working_title, 25) }}
                        </p>
                        <p class="text-xs text-gray-400">{{ $adminStats['my_recent_canvas']->created_at->diffForHumans() }}</p>
                    @else
                        <p class="text-sm text-gray-400">No canvases yet</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- System Statistics Section -->
    <div class="content-section">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">System Overview</h2>
                <p class="text-gray-600">Platform-wide statistics and user activity metrics</p>
            </div>
            <div class="icon-container">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"></path>
                </svg>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" style="display: grid !important; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)) !important; gap: 1rem !important;">
            <!-- Total Users -->
            <div class="modern-card">
                <div class="flex flex-col">
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-gray-500 text-sm font-medium">Total Users</p>
                        <div class="p-2 rounded-full bg-blue-50">
                            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-4xl font-bold text-gray-900 mb-2">{{ $systemStats['total_users'] }}</p>
                    <p class="text-xs text-gray-400">Registered users</p>
                </div>
            </div>

            <!-- Total Canvases -->
            <div class="modern-card">
                <div class="flex flex-col">
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-gray-500 text-sm font-medium">Total Canvases</p>
                        <div class="p-2 rounded-full bg-green-50">
                            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-4xl font-bold text-gray-900 mb-2">{{ $systemStats['total_canvases'] }}</p>
                    <p class="text-xs text-gray-400">Research canvases</p>
                </div>
            </div>

            <!-- This Month -->
            <div class="modern-card">
                <div class="flex flex-col">
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-gray-500 text-sm font-medium">This Month</p>
                        <div class="p-2 rounded-full bg-purple-50">
                            <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-4xl font-bold text-gray-900 mb-2">{{ $systemStats['canvases_this_month'] }}</p>
                    <p class="text-xs text-gray-400">New canvases</p>
                </div>
            </div>

            <!-- Total References -->
            <div class="modern-card">
                <div class="flex flex-col">
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-gray-500 text-sm font-medium">References</p>
                        <div class="p-2 rounded-full bg-orange-50">
                            <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-4xl font-bold text-gray-900 mb-2">{{ $systemStats['total_references'] }}</p>
                    <p class="text-xs text-gray-400">Research references</p>
                </div>
            </div>

            <!-- Total Nano Ideas -->
            <div class="modern-card">
                <div class="flex flex-col">
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-gray-500 text-sm font-medium">Nano Ideas</p>
                        <div class="p-2 rounded-full bg-indigo-50">
                            <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-4xl font-bold text-gray-900 mb-2">{{ $systemStats['total_nano_ideas'] }}</p>
                    <p class="text-xs text-gray-400">System-wide</p>
                </div>
            </div>

            <!-- Total Micro Ideas -->
            <div class="modern-card">
                <div class="flex flex-col">
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-gray-500 text-sm font-medium">Micro Ideas</p>
                        <div class="p-2 rounded-full bg-teal-50">
                            <svg class="w-6 h-6 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-4xl font-bold text-gray-900 mb-2">{{ $systemStats['total_micro_ideas'] }}</p>
                    <p class="text-xs text-gray-400">System-wide</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Users Activity Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent User Canvases - Large Card -->
        <div class="modern-card lg:col-span-2">
            <div class="flex justify-between items-center mb-4">
                <h2 class="card-title">Recent User Canvases</h2>
                <a href="{{ route('admin.recent_canvases') }}" class="btn-outline">View All</a>
            </div>
            <div class="space-y-3">
                @forelse($recentCanvases as $canvas)
                    <div class="p-3 border border-gray-200 rounded-md hover:bg-blue-50 transition-colors">
                        <div class="flex justify-between items-start mb-3">
                            <div class="flex-1 pr-4">
                                <h4 class="font-semibold text-gray-900 text-base mb-1">{{ Str::limit($canvas->research_working_title, 60) }}</h4>
                                <p class="text-sm text-gray-600">by {{ $canvas->user->name }}</p>
                            </div>
                            <div class="text-right flex-shrink-0">
                                <p class="text-sm text-gray-500 font-medium">{{ $canvas->created_at->format('M d, Y') }}</p>
                                <p class="text-xs text-gray-400">{{ $canvas->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <div class="flex gap-6 pt-2 border-t border-gray-100">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center mr-2">
                                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Nano Ideas</p>
                                    <p class="font-semibold text-gray-900">{{ $canvas->backgroundItems->count() }}</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-purple-50 flex items-center justify-center mr-2">
                                    <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Micro Flows</p>
                                    <p class="font-semibold text-gray-900">{{ $canvas->flows->count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-center py-4">No user canvases yet</p>
                @endforelse
            </div>
        </div>

        <!-- Top Users - Medium Card -->
        <div class="modern-card">
            <h2 class="card-title">Top Users by Canvas Count</h2>
            <div class="space-y-3">
                @forelse($topUsers as $index => $user)
                    <div class="flex justify-between items-center p-3 border border-gray-200 rounded-lg hover:bg-blue-50 transition-colors">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold mr-3
                                @if($index === 0) bg-blue-500 text-white
                                @elseif($index === 1) bg-blue-400 text-white
                                @elseif($index === 2) bg-blue-300 text-white
                                @else bg-blue-200 text-blue-800
                                @endif">
                                {{ $index + 1 }}
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">{{ $user->name }}</p>
                                <p class="text-sm text-gray-600">{{ $user->email }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-bold text-gray-900">{{ $user->canvases_count }}</p>
                            <p class="text-xs text-gray-500">canvases</p>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-center py-4">No users yet</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="content-section">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Quick Actions</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4" style="display: grid !important; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)) !important; gap: 1rem !important;">
        <a href="{{ route('admin.references.index') }}" class="action-card">
            <div class="flex items-center">
                <div class="action-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <div>
                    <p class="action-title">Manage References</p>
                    <p class="action-description">Upload and manage references</p>
                </div>
            </div>
        </a>

        <a href="{{ route('canvas.create') }}" class="action-card">
            <div class="flex items-center">
                <div class="action-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
                <div>
                    <p class="action-title">Create Canvas</p>
                    <p class="action-description">Start a new research canvas</p>
                </div>
            </div>
        </a>

        <a href="{{ route('canvas.index') }}" class="action-card">
            <div class="flex items-center">
                <div class="action-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div>
                    <p class="action-title">View All Canvases</p>
                    <p class="action-description">Browse all research canvases</p>
                </div>
            </div>
        </a>
        </div>
    </div>

    </div>
</div>
@endsection