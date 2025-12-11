@extends('layouts.app')
@php
    use Illuminate\Support\Str;
@endphp

@section('styles')
<link href="{{ asset('css/reference-theme.css') }}?v={{ time() }}" rel="stylesheet">
<style>
/* Match profile page button styling */
.btn, .btn-primary, .btn-secondary, .btn-outline, .action-btn, .add-btn, .back-button {
    border-radius: 8px !important;
    padding: 0.75rem 1.5rem !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 0.5rem !important;
    font-weight: 600 !important;
    text-decoration: none !important;
    white-space: nowrap !important;
    border: none !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
}

/* Ensure SVG icons are visible and styled properly */
.btn svg, .btn-primary svg, .btn-secondary svg, .btn-outline svg, .back-button svg {
    width: 1rem !important;
    height: 1rem !important;
    flex-shrink: 0 !important;
    display: inline-block !important;
    opacity: 1 !important;
    visibility: visible !important;
}

.back-button {
    background: #6b7280 !important;
    color: white !important;
}

.back-button:hover {
    background: #4b5563 !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 8px 20px rgba(0,0,0,0.12) !important;
    text-decoration: none !important;
}

.btn-primary:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}

.btn-outline:hover {
    background: #667eea !important;
    color: white !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3) !important;
}
</style>
@endsection

@section('content')
<!-- Hero Section with Gradient Background -->
<div class="hero-section">
    <div class="hero-content">
        <h1 class="hero-title">All Recent User Canvases</h1>
        <p class="hero-subtitle">Overview of all user research canvases and their progress</p>
    </div>
</div>

<div class="main-content">
    <div class="content-container">
        <!-- Action Bar -->
        <div class="content-section">
            <div class="action-bar">
                <div>
                    <a href="{{ route('admin.dashboard') }}" class="back-button">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Back to Dashboard
                    </a>
                </div>
                
                <!-- Search Form -->
                <div class="search-container">
                    <form method="GET" action="{{ route('admin.recent_canvases') }}" class="search-form">
                        <div class="search-input-group">
                            <input type="text" 
                                   name="search" 
                                   value="{{ $search ?? '' }}" 
                                   placeholder="Search by title..." 
                                   class="search-input">
                            <button type="submit" class="btn-primary search-button">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                Search
                            </button>
                        </div>
                        @if($search)
                            <a href="{{ route('admin.recent_canvases') }}" class="btn-outline clear-button">
                                Clear
                            </a>
                        @endif
                    </form>
                </div>
            </div>
        </div>

        <!-- Canvases Grid -->
        <div class="content-section">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse($recentCanvases as $canvas)
                <div class="reference-card">
                    <div class="reference-card-content">
                        <div class="flex items-start justify-between">
                            <div class="flex-1 min-w-0">
                                <h3 class="reference-card-title">{{ Str::limit($canvas->research_working_title, 60) }}</h3>
                                <div class="reference-card-meta">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    {{ $canvas->user->name }} • {{ $canvas->created_at->format('M d, Y') }}
                                </div>
                            </div>
                            <div class="reference-card-badge">Canvas</div>
                        </div>
                        
                        <!-- Simple Statistics -->
                        <div class="mt-4 flex gap-6">
                            <div class="flex items-center">
                                <div class="flex items-center justify-center w-8 h-8 bg-blue-100 rounded-full mr-2">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-600">Nano Ideas</span>
                                    <p class="font-semibold text-gray-900">{{ $canvas->backgroundItems->count() }}</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div class="flex items-center justify-center w-8 h-8 bg-green-100 rounded-full mr-2">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-600">Micro Ideas</span>
                                    <p class="font-semibold text-gray-900">{{ $canvas->flows->count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <div class="empty-state-content">
                        <svg class="empty-state-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <h3 class="empty-state-title">No Canvases Found</h3>
                        <p class="empty-state-description">{{ $search ? 'No canvases match your search criteria.' : 'No user canvases have been created yet.' }}</p>
                    </div>
                </div>
            @endforelse
            </div>
            
            <!-- Pagination -->
            @if($recentCanvases->hasPages())
            <div class="mt-8">
                {{ $recentCanvases->appends(['search' => $search])->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection