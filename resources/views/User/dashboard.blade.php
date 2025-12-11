@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/reference-theme.css') }}?v={{ time() }}" rel="stylesheet">
@endsection

@section('content')
@php
    use Illuminate\Support\Str;
    
    // Fallback for missing variables
    $totalCanvases = $totalCanvases ?? 0;
    $totalNanoIdeas = $totalNanoIdeas ?? 0;
    $totalMicroIdeas = $totalMicroIdeas ?? 0;
    $lastMonthCanvases = $lastMonthCanvases ?? 0;
    $lastWeekNanoIdeas = $lastWeekNanoIdeas ?? 0;
    $recentCanvas = $recentCanvas ?? null;
    $canvases = $canvases ?? collect();
@endphp

<div class="main-content">
    <div class="content-container" style="max-width: 1300px; margin: 0 auto;">
        <x-hero-section 
            title="My Research Dashboard" 
            subtitle="Welcome back, {{ auth()->user()->name }}. Continue your research journey." 
        />

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
                    <p class="text-4xl font-bold text-gray-900 mb-2">{{ $totalCanvases }}</p>
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
                    <p class="text-4xl font-bold text-gray-900 mb-2">{{ $totalNanoIdeas }}</p>
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
                    <p class="text-4xl font-bold text-gray-900 mb-2">{{ $totalMicroIdeas }}</p>
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
                    @if($recentCanvas)
                        <p class="text-lg font-bold text-gray-900 mb-1 truncate" title="{{ $recentCanvas->research_working_title }}">
                            {{ Str::limit($recentCanvas->research_working_title, 25) }}
                        </p>
                        <p class="text-xs text-gray-400">{{ $recentCanvas->created_at->diffForHumans() }}</p>
                    @else
                        <p class="text-sm text-gray-400">No canvases yet</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Canvases Section -->
    <div class="content-section">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">My Research Canvases</h2>
                <p class="text-gray-600">Your recent research projects and canvases</p>
            </div>
            <div class="icon-container">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
        </div>
        
        <!-- Canvas List -->
        <div class="modern-card">
            <div class="flex justify-between items-center mb-4">
                <h3 class="card-title">Recent Canvases</h3>
                <a href="{{ route('canvas.index') }}" class="btn-outline">View All</a>
            </div>
            <div class="space-y-3">
                @forelse($canvases as $canvas)
                    <div class="p-3 border border-gray-200 rounded-md hover:bg-blue-50 transition-colors">
                        <div class="flex justify-between items-start mb-3">
                            <div class="flex-1 pr-4">
                                <a href="{{ route('canvas.show', $canvas) }}" class="font-semibold text-gray-900 text-base mb-1 hover:text-blue-600 transition-colors">{{ Str::limit($canvas->research_working_title, 60) }}</a>
                                <p class="text-sm text-gray-600">Created {{ $canvas->created_at->format('M d, Y') }}</p>
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('canvas.edit', $canvas) }}" class="text-blue-600 hover:text-blue-800 p-1" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                <a href="{{ route('canvas.export', $canvas) }}" class="text-green-600 hover:text-green-800 p-1" title="Export">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </a>
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
                                    <p class="font-semibold text-gray-900">{{ $canvas->backgroundItems->count() ?? 0 }}</p>
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
                                    <p class="font-semibold text-gray-900">{{ $canvas->flows->count() ?? 0 }}</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-green-50 flex items-center justify-center mr-2">
                                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Last Updated</p>
                                    <p class="font-semibold text-gray-900">{{ $canvas->updated_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <p class="text-lg font-medium text-gray-500 mb-2">No research canvases yet</p>
                        <p class="text-sm text-gray-400 mb-4">Create your first research canvas to get started!</p>
                        <a href="{{ route('canvas.create') }}" style="display: inline-flex !important; align-items: center !important; padding: 0.75rem 1.5rem !important; background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%) !important; color: white !important; font-weight: 600 !important; border-radius: 0.75rem !important; text-decoration: none !important; box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3) !important; transition: all 0.3s ease !important; gap: 0.5rem !important;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 15px 35px rgba(59, 130, 246, 0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 25px rgba(59, 130, 246, 0.3)';">
                            <svg style="width: 1.25rem !important; height: 1.25rem !important;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Create Your First Canvas
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="content-section">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Quick Actions</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4" style="display: grid !important; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)) !important; gap: 1rem !important;">
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="action-title">View All Canvases</p>
                        <p class="action-description">Browse all research canvases</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('references.index') }}" class="action-card">
                <div class="flex items-center">
                    <div class="action-icon">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="action-title">Browse Library</p>
                        <p class="action-description">Access reference materials</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    </div>
</div>
@endsection