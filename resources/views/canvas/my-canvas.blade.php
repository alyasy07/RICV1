@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/reference-theme.css') }}">
<style>
    .main-content { 
        padding: 2rem 1rem !important; 
        min-height: 100vh !important; 
        background: linear-gradient(135deg, #f5f7fa 0%, #e4edf5 100%) !important;
    }
    
    /* Content container with subtle shadow */
    .content-container {
        max-width: 1300px !important;
        margin: 0 auto !important;
    }
    
    /* Enhanced content section styling */
    .content-section {
        background: white !important;
        padding: 28px !important;
        border-radius: 16px !important;
        margin-bottom: 24px !important;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08) !important;
        border: 1px solid rgba(102, 126, 234, 0.1) !important;
        transition: transform 0.3s ease, box-shadow 0.3s ease !important;
    }
    
    .content-section:hover {
        box-shadow: 0 8px 25px rgba(0,0,0,0.12) !important;
    }
    
    /* Improved search section */
    .search-filter-container {
        display: flex !important;
        justify-content: space-between !important;
        align-items: center !important;
        gap: 16px !important;
        flex-wrap: wrap !important;
    }
    
    .search-bar-container {
        display: flex !important;
        gap: 12px !important;
        flex: 0 1 auto !important;
        min-width: 300px !important;
        max-width: 500px !important;
    }
    
    .search-bar {
        flex: 1 !important;
        padding: 14px 20px !important;
        border: 2px solid #e2e8f0 !important;
        border-radius: 12px !important;
        font-size: 15px !important;
        background: #f8fafc !important;
        transition: all 0.3s ease !important;
        font-family: inherit !important;
    }
    
    .search-bar:focus {
        outline: none !important;
        border-color: #667eea !important;
        background: white !important;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.15) !important;
    }
    
    .search-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        color: white !important;
        padding: 14px 28px !important;
        border: none !important;
        border-radius: 12px !important;
        font-weight: 600 !important;
        font-size: 15px !important;
        cursor: pointer !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 8px !important;
        transition: all 0.3s ease !important;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3) !important;
        font-family: inherit !important;
    }
    
    .search-btn:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 6px 16px rgba(102, 126, 234, 0.4) !important;
    }
    
    .filter-actions {
        display: flex !important;
        gap: 12px !important;
        align-items: center !important;
    }
    
    .clear-btn {
        background: #64748b !important;
        color: white !important;
        padding: 14px 24px !important;
        border: none !important;
        border-radius: 12px !important;
        font-weight: 600 !important;
        font-size: 14px !important;
        cursor: pointer !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 8px !important;
        transition: all 0.3s ease !important;
        box-shadow: 0 2px 8px rgba(100, 116, 139, 0.3) !important;
        font-family: inherit !important;
    }
    
    .clear-btn:hover {
        background: #475569 !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 4px 12px rgba(100, 116, 139, 0.4) !important;
    }
    
    .add-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        color: white !important;
        padding: 14px 28px !important;
        border: none !important;
        border-radius: 12px !important;
        font-weight: 600 !important;
        font-size: 15px !important;
        cursor: pointer !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 8px !important;
        text-decoration: none !important;
        transition: all 0.3s ease !important;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3) !important;
        font-family: inherit !important;
    }
    
    .add-btn:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 6px 16px rgba(102, 126, 234, 0.4) !important;
    }
    
    /* Enhanced grid layout */
    .grid {
        display: grid !important;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)) !important;
        gap: 24px !important;
    }
    
    /* Improved card styling */
    .reference-card {
        background: white !important;
        border-radius: 16px !important;
        overflow: hidden !important;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08) !important;
        transition: all 0.3s ease !important;
        border: 1px solid rgba(102, 126, 234, 0.1) !important;
        height: 100% !important;
        display: flex !important;
        flex-direction: column !important;
    }
    
    .reference-card:hover {
        transform: translateY(-5px) !important;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
    }
    
    .reference-card-content {
        padding: 24px !important;
        flex-grow: 1 !important;
        display: flex !important;
        flex-direction: column !important;
    }
    
    .reference-card-title {
        font-size: 18px !important;
        font-weight: 700 !important;
        color: #1e293b !important;
        margin-bottom: 8px !important;
        line-height: 1.4 !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
        display: -webkit-box !important;
        -webkit-line-clamp: 2 !important;
        -webkit-box-orient: vertical !important;
    }
    
    .reference-card-meta {
        display: flex !important;
        align-items: center !important;
        font-size: 13px !important;
        color: #64748b !important;
        margin-bottom: 16px !important;
    }
    
    .reference-card-badge {
        display: inline-block !important;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        color: white !important;
        padding: 6px 12px !important;
        border-radius: 20px !important;
        font-size: 12px !important;
        font-weight: 600 !important;
        margin-bottom: 16px !important;
        align-self: flex-start !important;
    }
    
    .action-buttons { 
        display: flex !important;
        gap: 8px !important;
        margin-top: auto !important;
    }
    
    .action-buttons a,
    .action-buttons form,
    .action-buttons button { 
        flex-grow: 1 !important;
    }

    .action-buttons button {
        width: 100% !important;
    }
    
    .action-buttons a,
    .action-buttons button { 
        padding: 12px 8px !important;
        line-height: 1.2 !important;
        height: 100% !important;
        border-radius: 8px !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        text-decoration: none !important;
        border: none !important;
        cursor: pointer !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 6px !important;
        transition: all 0.3s ease !important;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1) !important;
        white-space: nowrap !important;
    }
    
    .btn-view { 
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important; 
        color: white !important; 
    }
    .btn-view:hover { 
        transform: translateY(-2px) !important;
        box-shadow: 0 4px 10px rgba(102, 126, 234, 0.4) !important;
    }
    
    .btn-edit { 
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%) !important; 
        color: white !important; 
    }
    .btn-edit:hover { 
        transform: translateY(-2px) !important;
        box-shadow: 0 4px 10px rgba(79, 172, 254, 0.4) !important;
    }
    
    .btn-download { 
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%) !important; 
        color: white !important; 
    }
    .btn-download:hover { 
        transform: translateY(-2px) !important;
        box-shadow: 0 4px 10px rgba(240, 147, 251, 0.4) !important;
    }
    
    .btn-delete { 
        background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%) !important; 
        color: white !important; 
    }
    .btn-delete:hover { 
        transform: translateY(-2px) !important;
        box-shadow: 0 4px 10px rgba(255, 154, 158, 0.4) !important;
    }
    
    /* Empty state styling */
    .empty-state {
        text-align: center !important;
        padding: 60px 20px !important;
        color: #64748b !important;
    }
    
    .empty-state-icon {
        width: 80px !important;
        height: 80px !important;
        margin: 0 auto 20px !important;
        color: #cbd5e1 !important;
    }
    
    .empty-state-title {
        font-size: 24px !important;
        font-weight: 700 !important;
        color: #475569 !important;
        margin-bottom: 12px !important;
    }
    
    .empty-state-description {
        font-size: 16px !important;
        margin-bottom: 24px !important;
        max-width: 500px !important;
        margin-left: auto !important;
        margin-right: auto !important;
        line-height: 1.6 !important;
    }
    
    /* Unified, Clean Pagination */
    .pagination-container {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 24px; /* Space between item count and nav links */
        margin-top: 2rem;
        flex-wrap: wrap;
    }

    .pagination-item-count {
        color: #64748b; 
        font-weight: 500;
        font-size: 0.875rem;
    }

    nav[role="navigation"] {
        text-align: center !important;
    }
    
    /* Hide default pagination summary text */
    nav[role="navigation"] p {
        display: none !important;
    }
    
    /* Main pagination container */
    nav[role="navigation"] > div {
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
        flex-wrap: wrap !important;
    }
    
    /* All pagination items */
    nav[role="navigation"] a,
    nav[role="navigation"] span {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        min-width: 38px !important;
        height: 38px !important;
        padding: 0 12px !important;
        margin: 0 !important;
        border-radius: 8px !important;
        font-weight: 600 !important;
        font-size: 14px !important;
        text-decoration: none !important;
        transition: all 0.2s ease !important;
        border: 1px solid #d1d5db !important;
        background: white !important;
        color: #374151 !important;
        line-height: 1 !important;
        box-sizing: border-box !important;
    }
    
    /* Hover state */
    nav[role="navigation"] a:hover {
        background: #667eea !important;
        border-color: #667eea !important;
        color: white !important;
    }
    
    /* Current page */
    nav[role="navigation"] span[aria-current="page"] {
        background: #667eea !important;
        border-color: #667eea !important;
        color: white !important;
        z-index: 1;
    }
    
    /* Disabled state */
    nav[role="navigation"] span[aria-disabled="true"],
    nav[role="navigation"] a[aria-disabled="true"] {
        background: #f9fafb !important;
        color: #d1d5db !important;
        cursor: not-allowed !important;
    }
    
    /* Ellipsis */
    nav[role="navigation"] span:not([aria-current]):not([aria-disabled]) {
        border: none !important;
        background: transparent !important;
        color: #9ca3af !important;
        padding: 0 6px !important;
        min-width: auto !important;
    }
    
    /* Success alert styling */
    .alert-success {
        position: fixed !important;
        top: 1rem !important;
        right: 1rem !important;
        z-index: 1000 !important;
        min-width: 300px !important;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
        color: white !important;
        padding: 16px 20px !important;
        border-radius: 12px !important;
        box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3) !important;
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
        font-weight: 500 !important;
        animation: slideInRight 0.5s ease !important;
    }
    
    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    /* Confirmation Modal Styles */
    .confirm-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        z-index: 2000;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        font-family: 'Inter', sans-serif;
    }

    .confirm-modal.active {
        display: flex;
        opacity: 1;
    }

    .confirm-modal-content {
        background: white;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        width: 90%;
        max-width: 450px;
        text-align: center;
        padding: 2.5rem;
        transform: scale(0.95);
        transition: transform 0.3s ease;
    }

    .confirm-modal.active .confirm-modal-content {
        transform: scale(1);
    }

    .confirm-modal-icon {
        font-size: 3rem;
        color: #ef4444; /* Red for warning */
        margin-bottom: 1.5rem;
    }

    .confirm-modal-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.75rem;
    }

    .confirm-modal-text {
        color: #64748b;
        margin-bottom: 2rem;
        font-size: 1rem;
    }

    .confirm-modal-actions {
        display: flex;
        justify-content: center;
        gap: 1rem;
    }

    .confirm-btn {
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        font-size: 1rem;
        transition: all 0.2s;
        min-width: 120px;
    }

    .btn-confirm-delete {
        background: #ef4444;
        color: white;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    .btn-confirm-delete:hover {
        background: #dc2626;
        transform: translateY(-2px);
    }

    .btn-confirm-cancel {
        background: #f1f5f9;
        color: #475569;
        border: 1px solid #e2e8f0;
    }

    .btn-confirm-cancel:hover {
        background: #e2e8f0;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .main-content {
            padding: 1rem 0.5rem !important;
        }
        
        .content-section {
            padding: 20px !important;
        }
        
        .search-filter-container {
            flex-direction: column !important;
            align-items: stretch !important;
        }
        
        .search-bar-container {
            min-width: 100% !important;
            max-width: 100% !important;
        }
        
        .filter-actions {
            justify-content: center !important;
        }
        
        .grid {
            grid-template-columns: 1fr !important;
        }
        
        .action-buttons {
            grid-template-columns: repeat(2, minmax(120px, 1fr)) !important;
        }
        
        .action-buttons a,
        .action-buttons button {
            font-size: 12px !important;
        }
    }
</style>
@endsection

@section('content')
<div class="main-content">
    <div class="content-container" style="max-width: 1300px; margin: 0 auto;">
        <x-hero-section 
            title="My Research Canvases" 
            subtitle="Manage and organize all your research projects in one place" 
        />
        <!-- Search and Filter Section -->
        <div class="content-section">
            <div class="search-filter-container">
                <form method="GET" action="{{ route('canvas.index') }}" class="search-bar-container">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') ?? '' }}" 
                           placeholder="Search canvases..." 
                           class="search-bar">
                    <button type="submit" class="search-btn">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Search
                    </button>
                </form>
                
                <div class="filter-actions">
                    @if(request('search'))
                        <button onclick="window.location='{{ route('canvas.index') }}'" class="clear-btn">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Clear
                        </button>
                    @endif
                    
                    <a href="{{ route('canvas.create') }}" class="add-btn">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        New Canvas
                    </a>
                </div>
            </div>
        </div>

        <!-- Canvas Grid -->
        <div class="content-section">
            @if($canvases->isEmpty())
                <div class="empty-state">
                    @if(request('search'))
                        <svg class="empty-state-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <h3 class="empty-state-title">No Results Found</h3>
                        <p class="empty-state-description">Your search for "{{ request('search') }}" did not return any results.</p>
                        <a href="{{ route('canvas.index') }}" class="add-btn">Clear Search</a>
                    @else
                        <svg class="empty-state-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <h3 class="empty-state-title">No Canvases Yet</h3>
                        <p class="empty-state-description">Create your first research canvas to get started with your projects!</p>
                        <a href="{{ route('canvas.create') }}" class="add-btn">Create New Canvas</a>
                    @endif
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($canvases as $canvas)
                        <div class="reference-card">
                            <div class="reference-card-content">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex-1 min-w-0">
                                        <h3 class="reference-card-title">{{ $canvas->research_working_title }}</h3>
                                        <div class="reference-card-meta">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 01-2 2z"></path>
                                            </svg>
                                            {{ $canvas->created_at->format('M d, Y') }}
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="reference-card-badge">Canvas</div>
                                
                                <div class="action-buttons">
                                    <a href="{{ route('canvas.show', $canvas) }}" class="btn-view">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        View
                                    </a>
                                    <a href="{{ route('canvas.edit', $canvas) }}" class="btn-edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Edit
                                    </a>
                                    <a href="{{ route('canvas.export', $canvas->id) }}" class="btn-download">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        Download
                                    </a>
                                    <form action="{{ route('canvas.destroy', $canvas) }}" method="POST" style="display: inline;" class="delete-form" data-canvas-title="{{ $canvas->canvas_title ?? $canvas->thesis_title }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="showDeleteModal(this)" class="btn-delete">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($canvases->hasPages())
                <div class="pagination-container">
                    @if($canvases->total() > 0)
                        <div class="pagination-item-count">
                            Showing {{ $canvases->firstItem() }} to {{ $canvases->lastItem() }} of {{ $canvases->total() }} canvases
                        </div>
                    @endif
                    
                    {{ $canvases->appends(['search' => request('search')])->links() }}
                </div>
                @elseif($canvases->total() > 0)
                    <div class="pagination-container">
                        <div class="pagination-item-count">
                            Showing {{ $canvases->firstItem() }} to {{ $canvases->lastItem() }} of {{ $canvases->total() }} canvases
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success" style="position: fixed; top: 1rem; right: 1rem; z-index: 1000; min-width: 300px;">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        {{ session('success') }}
    </div>
@endif

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="confirm-modal">
    <div class="confirm-modal-content">
        <div class="confirm-modal-icon" style="background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); color: #dc2626;">
            <i class="fas fa-trash-alt" style="font-size: 1.8rem;"></i>
        </div>
        <h2 class="confirm-modal-title">Delete Canvas</h2>
        <p id="deleteMessage" class="confirm-modal-text">Are you sure you want to delete this canvas? This action cannot be undone.</p>
        <div class="confirm-modal-actions">
            <button type="button" onclick="hideDeleteModal()" class="btn confirm-btn btn-confirm-cancel">Cancel</button>
            <button type="button" onclick="confirmDelete()" class="btn confirm-btn btn-confirm-delete">
                <i class="fas fa-trash"></i> Delete
            </button>
        </div>
    </div>
</div>

<script>
let deleteFormToSubmit = null;

function showDeleteModal(button) {
    const form = button.closest('form');
    const canvasTitle = form.dataset.canvasTitle;
    deleteFormToSubmit = form;
    
    const message = canvasTitle ? 
        `Are you sure you want to delete "${canvasTitle}"? This action cannot be undone.` :
        'Are you sure you want to delete this canvas? This action cannot be undone.';
    
    document.getElementById('deleteMessage').textContent = message;
    document.getElementById('deleteModal').classList.add('active');
    document.body.style.overflow = 'hidden';
}

function hideDeleteModal() {
    document.getElementById('deleteModal').classList.remove('active');
    document.body.style.overflow = 'auto';
    deleteFormToSubmit = null;
}

function confirmDelete() {
    if (deleteFormToSubmit) {
        deleteFormToSubmit.submit();
    }
}

// Close modal when clicking outside
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('deleteModal');
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                hideDeleteModal();
            }
        });
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        hideDeleteModal();
    }
});

    document.addEventListener('DOMContentLoaded', function() {
        const modal_old = document.getElementById('confirmationModal');
        if (!modal_old) return;

        function hideModal_old() {
            if (modal_old) modal_old.classList.remove('active');
        }

        cancelButton.addEventListener('click', hideModal);
        confirmButton.addEventListener('click', function() {
            if (formToSubmit) {
                formToSubmit.submit();
            }
            hideModal();
        });

        modal.addEventListener('click', function(event) {
            if (event.target === modal) {
                hideModal();
            }
        });

        // Replace default confirm
        document.querySelectorAll('button[onclick*="confirm("]').forEach(button => {
            button.setAttribute('onclick', 'showConfirmationModal(event)');
        });
    });
</script>
@endsection
