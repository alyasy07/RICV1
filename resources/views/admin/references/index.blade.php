@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/reference-theme.css') }}">
<style>
    :root {
        --primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --secondary: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --success: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        --primary-color: #667eea;
        --secondary-color: #764ba2;
        --accent-color: #f093fb;
        --text-dark: #2d3748;
        --text-medium: #4a5568;
        --text-light: #718096;
        --white: #ffffff;
        --bg-light: #f7fafc;
        --bg-gradient: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 50%, #fff3e0 100%);
        --border-color: #e2e8f0;
        --shadow-sm: 0 2px 4px rgba(0,0,0,0.05);
        --shadow-md: 0 4px 6px rgba(0,0,0,0.07);
        --shadow-lg: 0 10px 25px rgba(0,0,0,0.1);
        --shadow-xl: 0 20px 40px rgba(0,0,0,0.15);
        --border-radius: 16px;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }

    body {
        background: var(--bg-gradient);
        color: var(--text-dark);
        line-height: 1.6;
        min-height: 100vh;
    }

    .main-content { 
        padding: 2rem 1rem; 
        min-height: 100vh; 
    }

    .hero-section {
        background: var(--white);
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-lg);
        padding: 3rem 2.5rem;
        margin-bottom: 1.5rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .hero-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 2rem;
    }

    .hero-title {
        font-size: 2.2rem;
        font-weight: 800;
        margin-bottom: 0.75rem;
        line-height: 1.3;
        background: linear-gradient(135deg, #ffffff 0%, #e3f2fd 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-subtitle {
        font-size: 1.1rem;
        opacity: 0.95;
        font-weight: 500;
    }

    .add-btn {
        background: var(--primary-color);
        color: var(--white);
        padding: 0.7rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: var(--shadow-md);
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        font-size: 0.9rem;
        white-space: nowrap;
        height: 48px;
    }

    .add-btn:hover {
        transform: translateY(-1px);
        box-shadow: var(--shadow-lg);
        background: var(--secondary-color);
    }

    .filters-section {
        background: var(--white);
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-md);
        padding: 2rem 2.5rem;
        margin-bottom: 1.5rem;
    }

    .filter-bar {
        display: grid;
        grid-template-columns: 1fr auto auto;
        gap: 1rem;
        align-items: end;
    }

    .search-group {
        display: flex;
        flex-direction: column;
    }

    .filter-label {
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .search-input-group {
        display: flex;
        align-items: center;
        background: var(--white);
        border: 2px solid var(--border-color);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        transition: all 0.3s ease;
        width: 350px;
        height: 48px;
    }

    .search-input-group:focus-within {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .search-input {
        flex: 1;
        padding: 0.7rem 1.2rem;
        border: none;
        outline: none;
        background: transparent;
        font-size: 0.95rem;
        color: var(--text-dark);
        height: 100%;
    }

    .search-button {
        padding: 0.7rem 1.5rem;
        background: var(--primary-color);
        color: white;
        border: none;
        border-radius: 0;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        white-space: nowrap;
        height: 48px;
    }

    .search-button:hover {
        background: var(--secondary-color);
    }

    .filter-select {
        padding: 0.7rem 1rem;
        border: 2px solid var(--border-color);
        border-radius: 12px;
        background: var(--bg-light);
        color: var(--text-dark);
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        min-width: 150px;
        height: 48px;
        font-size: 0.95rem;
    }

    .filter-select:focus {
        outline: none;
        border-color: var(--primary-color);
        background: var(--white);
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .filter-actions {
        display: flex;
        gap: 0.5rem;
    }

    .filter-btn {
        padding: 0.7rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        font-size: 0.9rem;
        white-space: nowrap;
        text-decoration: none;
        height: 48px;
    }

    .btn-filter {
        background: var(--primary-color);
        color: white;
    }

    .btn-filter:hover {
        background: var(--secondary-color);
        transform: translateY(-1px);
    }

    .btn-clear {
        background: var(--text-light);
        color: white;
    }

    .btn-clear:hover {
        background: var(--text-medium);
        transform: translateY(-1px);
    }

    .references-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 1.5rem;
        margin-bottom: 1.25rem;
    }

    .reference-card {
        background: var(--white);
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-md);
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid transparent;
    }

    .reference-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
        border-color: var(--primary-color);
    }

    .card-thumbnail {
        position: relative;
        height: 180px;
        overflow: hidden;
        background: var(--bg-gradient);
    }

    .thumbnail-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .reference-card:hover .thumbnail-image {
        transform: scale(1.05);
    }

    .thumbnail-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        font-size: 4rem;
        background: var(--bg-gradient);
    }

    .file-type-badge {
        position: absolute;
        top: 1rem;
        right: 1rem;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: white;
        backdrop-filter: blur(10px);
        background: rgba(0, 0, 0, 0.7);
    }

    .card-content {
        padding: 1.5rem;
    }

    .card-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 0.75rem;
        line-height: 1.3;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .card-description {
        color: var(--text-medium);
        margin-bottom: 1rem;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .card-meta {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.75rem;
        margin-bottom: 1.25rem;
        padding: 1rem;
        background: var(--bg-light);
        border-radius: 8px;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.85rem;
        color: var(--text-medium);
    }

    .meta-icon {
        width: 16px;
        color: var(--primary-color);
    }

    .card-actions {
        display: flex;
        gap: 0.5rem;
    }

    .action-btn {
        flex: 1;
        padding: 0.75rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.9rem;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn-view {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
    }

    .btn-edit {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        color: white;
    }

    .btn-delete {
        background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        color: white;
    }

    .action-btn:hover {
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 4rem 2rem;
        background: var(--white);
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-md);
    }

    .empty-icon {
        font-size: 5rem;
        color: var(--text-light);
        margin-bottom: 1.5rem;
    }

    .empty-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 0.75rem;
    }

    .empty-message {
        color: var(--text-medium);
        font-size: 1.1rem;
        margin-bottom: 2rem;
    }

    .pagination-section {
        background: var(--white);
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-md);
        padding: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .pagination-info {
        color: var(--text-medium);
        font-weight: 500;
    }

    /* Alert styles */
    .alert {
        position: fixed;
        top: 1rem;
        right: 1rem;
        z-index: 1000;
        min-width: 300px;
        padding: 16px 20px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 500;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        animation: slideInRight 0.5s ease;
    }

    .alert-success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
    }

    .alert-error {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
    }

    .alert-fade-out {
        animation: fadeOut 0.5s ease-out forwards;
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

    @keyframes fadeOut {
        from {
            opacity: 1;
            transform: translateY(0);
        }
        to {
            opacity: 0;
            transform: translateY(-10px);
        }
    }

    /* Delete Modal Styles */
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(4px);
        z-index: 9999;
        align-items: center;
        justify-content: center;
        animation: fadeIn 0.2s ease;
    }

    .modal-overlay.active {
        display: flex;
    }

    .modal-container {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        max-width: 500px;
        width: 90%;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        animation: slideUp 0.3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideUp {
        from { 
            opacity: 0;
            transform: translateY(20px);
        }
        to { 
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 768px) {
        .main-content {
            padding: 1rem;
        }
        
        .hero-section {
            padding: 2rem 1.5rem;
        }
        
        .hero-content {
            text-align: center;
            flex-direction: column;
            gap: 1.5rem;
        }

        .hero-title {
            font-size: 1.8rem;
        }

        .filters-section {
            padding: 1.5rem;
        }

        .filter-bar {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        .references-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
    }
</style>
<main class="main-content">
    <div class="content-container" style="max-width: 1300px; margin: 0 auto;">
        <!-- Alert Messages -->
        @if(session('success'))
            <div class="alert alert-success" id="successAlert">
                <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-error" id="errorAlert">
                <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                {{ session('error') }}
            </div>
        @endif

        <!-- Hero Section -->
        <section class="hero-section">
            <div class="hero-content" style="text-align: center; justify-content: center;">
                <div>
                    <h1 class="hero-title">
                        References
                    </h1>
                    <p class="hero-subtitle">Discover, organize, and manage your research materials</p>
                </div>
            </div>
        </section>

        <!-- Filters Section -->
        <section class="filters-section">
            <form method="GET" action="{{ route('admin.references.index') }}" class="filter-bar">
                <div class="search-group">
                    <label class="filter-label">Search References</label>
                    <div class="search-input-group">
                        <input type="text" class="search-input" name="search" 
                               placeholder="Search references..." 
                               value="{{ request('search') }}">
                        <button type="submit" class="search-button btn-primary">
                            <i class="fas fa-search"></i>
                            Search
                        </button>
                    </div>
                </div>
                
                <div>
                    <label class="filter-label">File Type</label>
                    <select class="filter-select" name="type" onchange="this.form.submit()">
                        <option value="all" {{ request('type') == 'all' || !request('type') ? 'selected' : '' }}>All Types</option>
                        <option value="pdf" {{ request('type') == 'pdf' ? 'selected' : '' }}>📄 PDF</option>
                        <option value="doc" {{ request('type') == 'doc' ? 'selected' : '' }}>📝 Word</option>
                        <option value="ppt" {{ request('type') == 'ppt' ? 'selected' : '' }}>📊 PowerPoint</option>
                        <option value="link" {{ request('type') == 'link' ? 'selected' : '' }}>🔗 Link</option>
                    </select>
                </div>
                
                <div class="filter-actions">
                    @if(request('search') || request('type') != 'all')
                        <a href="{{ route('admin.references.index') }}" class="filter-btn btn-clear">
                            <i class="fas fa-times"></i>
                            Clear
                        </a>
                    @endif
                    <a href="{{ route('admin.references.create') }}" class="add-btn">
                        <i class="fas fa-plus"></i>
                        Add Reference
                    </a>
                </div>
            </form>
        </section>

        <!-- References Grid -->
        <div class="references-grid">
            @forelse($references as $reference)
                <article class="reference-card" data-ref-id="{{ $reference->id }}" data-has-thumb="{{ $reference->thumbnail_path ? 'yes' : 'no' }}">
                    <div class="card-thumbnail">
                        @if($reference->thumbnail_path)
                            <img src="{{ asset('storage/' . $reference->thumbnail_path) }}?v={{ $reference->updated_at->timestamp }}" 
                                 alt="{{ $reference->title }}" 
                                 class="thumbnail-image"
                                 loading="eager"
                                 onerror="console.error('Image failed to load:', this.src, 'Path:', '{{ $reference->thumbnail_path }}'); this.parentElement.innerHTML='<div class=\'thumbnail-placeholder\'><i class=\'fas fa-image\'></i><small>Image Error</small></div>';">
                        @else
                            <div class="thumbnail-placeholder">
                                @if($reference->reference_type === 'link')
                                    <i class="fas fa-external-link-alt" style="color: #667eea;"></i>
                                @else
                                    @switch($reference->file_type)
                                        @case('pdf')
                                            <i class="fas fa-file-pdf" style="color: #e53e3e;"></i>
                                            @break
                                        @case('doc')
                                        @case('docx')
                                            <i class="fas fa-file-word" style="color: #2b6cb0;"></i>
                                            @break
                                        @case('ppt')
                                        @case('pptx')
                                            <i class="fas fa-file-powerpoint" style="color: #d69e2e;"></i>
                                            @break
                                        @case('xls')
                                        @case('xlsx')
                                            <i class="fas fa-file-excel" style="color: #38a169;"></i>
                                            @break
                                        @default
                                            <i class="fas fa-file" style="color: #718096;"></i>
                                    @endswitch
                                @endif
                            </div>
                        @endif
                        <div class="file-type-badge">
                            {{ $reference->reference_type === 'link' ? 'LINK' : strtoupper($reference->file_type) }}
                        </div>
                    </div>
                    
                    <div class="card-content">
                        <h3 class="card-title">{{ $reference->title }}</h3>
                        
                        @if($reference->description)
                            <p class="card-description">{{ $reference->description }}</p>
                        @endif

                        <div class="card-meta">
                            <div class="meta-item">
                                <i class="fas fa-weight-hanging meta-icon"></i>
                                <span>{{ $reference->file_size_human }}</span>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-calendar-alt meta-icon"></i>
                                <span>{{ $reference->created_at->format('M j, Y') }}</span>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-clock meta-icon"></i>
                                <span>{{ $reference->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-user meta-icon"></i>
                                <span>{{ optional($reference->uploader)->name ?? 'Unknown' }}</span>
                            </div>
                        </div>

                        <div class="card-actions">
                            @if($reference->reference_type === 'link')
                                <button class="action-btn btn-view" onclick="showLinkModal({{ $reference->id }}, '{{ addslashes($reference->title) }}', '{{ $reference->url }}', '{{ addslashes($reference->description) }}', '{{ $reference->thumbnail_path ? asset('storage/' . $reference->thumbnail_path) : '' }}')">
                                    <i class="fas fa-eye"></i>
                                    View
                                </button>
                            @else
                                <button class="action-btn btn-view" onclick="showFileModal({{ $reference->id }}, '{{ addslashes($reference->title) }}', '{{ $reference->file_type }}', '{{ addslashes($reference->description) }}', '{{ $reference->thumbnail_path ? asset('storage/' . $reference->thumbnail_path) : '' }}', '{{ asset('storage/' . $reference->file_path) }}', '{{ $reference->file_size_human }}', '{{ $reference->created_at->format('M j, Y') }}', '{{ $reference->created_at->diffForHumans() }}', '{{ optional($reference->uploader)->name ?? 'Unknown' }}')">
                                    <i class="fas fa-eye"></i>
                                    View
                                </button>
                            @endif
                            <a href="{{ route('admin.references.edit', $reference) }}" class="action-btn btn-edit">
                                <i class="fas fa-edit"></i>
                                Edit
                            </a>
                            <form action="{{ route('admin.references.destroy', $reference) }}" method="POST" 
                                  class="delete-form" data-ref-title="{{ $reference->title }}" style="flex: 1;">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="showDeleteModal(this)" class="action-btn btn-delete" style="width: 100%;">
                                    <i class="fas fa-trash"></i>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </article>
            @empty
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <h2 class="empty-title">No References Found</h2>
                    <p class="empty-message">
                        @if(request('search') || request('type') != 'all')
                            No references match your current filters. Try adjusting your search or clearing the filters.
                        @else
                            Start building your reference library by uploading your first document.
                        @endif
                    </p>
                    @if(!request('search') && request('type') == 'all')
                        <a href="{{ route('admin.references.create') }}" class="add-btn">
                            <i class="fas fa-plus"></i>
                            Upload First Reference
                        </a>
                    @endif
                </div>
            @endforelse
        </div>

        <!-- Pagination Section -->
        @if($references->hasPages())
            <section class="pagination-section" style="background: var(--white); border-radius: var(--border-radius); box-shadow: var(--shadow-md); padding: 2rem 2.5rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                <div class="pagination-info" style="color: var(--text-medium); font-weight: 500;">
                    Showing {{ $references->firstItem() ?? 0 }} to {{ $references->lastItem() ?? 0 }} 
                    of {{ $references->total() }} references
                </div>
                <div class="pagination-nav">
                    {{ $references->links() }}
                </div>
            </section>
        @endif
    </div>
</main>

<!-- Link Modal -->
<div id="linkModal" class="modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
    <div class="modal-content" style="background: white; border-radius: 16px; box-shadow: 0 20px 40px rgba(0,0,0,0.15); width: 90%; max-width: 600px; max-height: 90vh; overflow-y: auto;">
        <div class="modal-header" style="padding: 2rem 2rem 1rem; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: flex-start;">
            <div style="flex: 1;">
                <h2 id="modalTitle" style="font-size: 1.5rem; font-weight: 700; color: #2d3748; margin-bottom: 0.5rem; line-height: 1.3;">Link Title</h2>
                <div style="display: flex; align-items: center; gap: 1rem; margin-top: 1rem;">
                    <span style="background: #667eea; color: white; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">Link</span>
                    <span style="color: #718096; font-size: 0.9rem;">Type: Link</span>
                </div>
            </div>
            <button onclick="closeLinkModal()" style="background: none; border: none; font-size: 1.5rem; color: #718096; cursor: pointer; padding: 0.5rem;">&times;</button>
        </div>
        
        <div class="modal-body" style="padding: 2rem;">
            <div id="modalThumbnail" style="width: 100%; height: 200px; background: #f8fafc; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; overflow: hidden;">
                <i class="fas fa-external-link-alt" style="font-size: 3rem; color: #667eea;"></i>
            </div>
            
            <div style="background: #667eea; padding: 1rem 1.5rem; border-radius: 12px; margin-bottom: 1.5rem;">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <i class="fas fa-external-link-alt" style="color: white; font-size: 1.1rem;"></i>
                    <a id="modalUrl" href="#" target="_blank" style="color: white; text-decoration: underline; font-weight: 500; flex: 1; word-break: break-all;">Link URL</a>
                </div>
            </div>
            
            <p style="color: #718096; text-align: center; margin-bottom: 1rem;">Click the link above to open in a new tab</p>
            
            <div id="modalDescription" style="color: #4a5568; line-height: 1.6; margin-bottom: 1.5rem;"></div>
        </div>
        
        <div class="modal-footer" style="padding: 1rem 2rem 2rem; display: flex; justify-content: flex-end;">
            <button onclick="closeLinkModal()" class="btn" style="background: #667eea; color: white; padding: 0.75rem 1.5rem; border-radius: 12px; border: none; font-weight: 600; cursor: pointer;">Close</button>
        </div>
    </div>
</div>

<!-- File Modal -->
<div id="fileModal" class="modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
    <div class="modal-content" style="background: white; border-radius: 16px; box-shadow: 0 20px 40px rgba(0,0,0,0.15); width: 90%; max-width: 800px; max-height: 90vh; overflow-y: auto;">
        <div class="modal-header" style="padding: 2rem 2rem 1rem; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: flex-start; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 16px 16px 0 0;">
            <div style="flex: 1;">
                <h2 id="fileModalTitle" style="font-size: 1.8rem; font-weight: 800; margin-bottom: 1rem; line-height: 1.3; background: linear-gradient(135deg, #ffffff 0%, #e3f2fd 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">File Title</h2>
                <div id="fileModalMeta" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 0.75rem; opacity: 0.95;">
                    <!-- Meta items will be populated by JavaScript -->
                </div>
            </div>
            <div id="fileModalThumbnail" style="flex-shrink: 0; width: 180px; height: 135px; border-radius: 12px; overflow: hidden; background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); display: flex; align-items: center; justify-content: center; border: 2px solid rgba(255, 255, 255, 0.2); margin-left: 3rem;">
                <i class="fas fa-file" style="font-size: 3rem; color: rgba(255, 255, 255, 0.7);"></i>
            </div>
            <button onclick="closeFileModal()" style="background: none; border: none; font-size: 1.5rem; color: rgba(255, 255, 255, 0.7); cursor: pointer; padding: 0.5rem; margin-left: 1rem;">&times;</button>
        </div>
        
        <div class="modal-body" style="padding: 2rem;">
            <div id="fileModalDescription" style="background: white; border-radius: 16px; box-shadow: 0 4px 6px rgba(0,0,0,0.07); padding: 1.25rem 1.5rem; margin-bottom: 1.25rem;">
                <h3 style="font-size: 1.2rem; font-weight: 700; color: #2d3748; margin-bottom: 0.75rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fas fa-align-left"></i> Description
                </h3>
                <div id="fileModalDescriptionContent" style="color: #4a5568; line-height: 1.7; font-size: 1.05rem;">No description provided.</div>
            </div>
            
            <!-- Actions moved into modal viewer footer dynamically via JavaScript -->
            
            <div id="fileModalViewer" style="background: white; border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); overflow: hidden;">
                <!-- PDF viewer will be loaded here -->
            </div>
        </div>
    </div>
</div>

<script>
function showLinkModal(id, title, url, description, thumbnail) {
    document.getElementById('modalTitle').textContent = title;
    document.getElementById('modalUrl').href = url;
    document.getElementById('modalUrl').textContent = url;
    document.getElementById('modalDescription').textContent = description || 'No description provided.';
    
    const thumbnailContainer = document.getElementById('modalThumbnail');
    if (thumbnail) {
        thumbnailContainer.innerHTML = `<img src="${thumbnail}" alt="${title}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 12px;">`;
    } else {
        thumbnailContainer.innerHTML = '<i class="fas fa-external-link-alt" style="font-size: 3rem; color: #667eea;"></i>';
    }
    
    document.getElementById('linkModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeLinkModal() {
    document.getElementById('linkModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

function showFileModal(id, title, fileType, description, thumbnail, filePath, fileSize, createdDate, timeAgo, uploader) {
    document.getElementById('fileModalTitle').textContent = title;
    document.getElementById('fileModalDescriptionContent').innerHTML = description || 'No description provided.';
    
    // Update meta information
    const metaContainer = document.getElementById('fileModalMeta');
    metaContainer.innerHTML = `
        <div style="display: flex; align-items: center; gap: 0.75rem; font-size: 1rem; font-weight: 500;">
            <i class="fas fa-user" style="width: 20px; text-align: center; font-size: 1.1rem;"></i>
            <span>${uploader}</span>
        </div>
        <div style="display: flex; align-items: center; gap: 0.75rem; font-size: 1rem; font-weight: 500;">
            <i class="fas fa-calendar-alt" style="width: 20px; text-align: center; font-size: 1.1rem;"></i>
            <span>${createdDate}</span>
        </div>
        <div style="display: flex; align-items: center; gap: 0.75rem; font-size: 1rem; font-weight: 500;">
            <i class="fas fa-clock" style="width: 20px; text-align: center; font-size: 1.1rem;"></i>
            <span>${timeAgo}</span>
        </div>
        <div style="display: flex; align-items: center; gap: 0.75rem; font-size: 1rem; font-weight: 500;">
            <i class="fas fa-file-alt" style="width: 20px; text-align: center; font-size: 1.1rem;"></i>
            <span>${fileType.toUpperCase()}</span>
        </div>
        <div style="display: flex; align-items: center; gap: 0.75rem; font-size: 1rem; font-weight: 500;">
            <i class="fas fa-weight-hanging" style="width: 20px; text-align: center; font-size: 1.1rem;"></i>
            <span>${fileSize}</span>
        </div>
    `;
    
    // Update thumbnail
    const thumbnailContainer = document.getElementById('fileModalThumbnail');
    if (thumbnail) {
        thumbnailContainer.innerHTML = `<img src="${thumbnail}" alt="${title}" style="width: 100%; height: 100%; object-fit: cover;">`;
    } else {
        let iconClass = 'fas fa-file';
        let iconColor = 'rgba(255, 255, 255, 0.7)';
        
        switch(fileType) {
            case 'pdf': iconClass = 'fas fa-file-pdf'; break;
            case 'doc':
            case 'docx': iconClass = 'fas fa-file-word'; break;
            case 'ppt':
            case 'pptx': iconClass = 'fas fa-file-powerpoint'; break;
            case 'xls':
            case 'xlsx': iconClass = 'fas fa-file-excel'; break;
        }
        
        thumbnailContainer.innerHTML = `<div style="text-align: center;"><i class="${iconClass}" style="font-size: 3rem; margin-bottom: 0.5rem; display: block; color: ${iconColor};"></i><small style="color: ${iconColor};">No Thumbnail</small></div>`;
    }
    
    // Update viewer section
    const viewerContainer = document.getElementById('fileModalViewer');
    if (fileType === 'pdf') {
        viewerContainer.innerHTML = `
            <div style="padding: 1rem 2rem; background: #f7fafc; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between; gap: 1.5rem;">
                <div style="font-size: 1.25rem; font-weight: 700; color: #2d3748; display: flex; align-items: center; gap: 0.75rem; flex: 1;">
                    <i class="fas fa-file-pdf"></i> PDF Viewer
                </div>
                <div style="display: flex; gap: 0.75rem;">
                    <a href="${filePath}" target="_blank" style="padding: 0.7rem 1.2rem; border: 1px solid #e2e8f0; border-radius: 8px; background: white; color: #4a5568; cursor: pointer; transition: all 0.2s ease; font-size: 0.9rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;" title="Open in New Tab">
                        <i class="fas fa-external-link-alt"></i> Open in New Tab
                    </a>
                </div>
            </div>
            <embed src="${filePath}" type="application/pdf" style="width: 100%; height: 700px; border: none;" title="PDF Viewer - ${title}" id="pdfViewerModal">
        `;

        // add footer actions to keep buttons at the bottom of the modal
        const footerHTML_pdf = `
            <div style="padding:1.5rem 2rem; border-top:1px solid #e2e8f0; display:flex; justify-content:center; gap:1rem; background:white; border-bottom-left-radius:16px; border-bottom-right-radius:16px;">
                <a href="${filePath}" target="_blank" style="display:inline-flex; align-items:center; gap:0.75rem; padding:1rem 1.5rem; border-radius:12px; background:linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color:white; text-decoration:none; font-weight:600; max-width:250px;">
                    <i class="fas fa-external-link-alt"></i> Open
                </a>
                <a href="/admin/references/${id}/edit" style="display:inline-flex; align-items:center; gap:0.75rem; padding:1rem 1.5rem; border-radius:12px; background:linear-gradient(135deg, #ffeaa7 0%, #fab1a0 100%); color:white; text-decoration:none; font-weight:600; max-width:200px;">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <button onclick="closeFileModal()" style="display:inline-flex; align-items:center; gap:0.75rem; padding:1rem 1.5rem; border-radius:12px; background:white; border:2px solid #e2e8f0; color:#2d3748; font-weight:600; max-width:200px; cursor:pointer;">
                    <i class="fas fa-times"></i> Close
                </button>
            </div>
        `;
        viewerContainer.insertAdjacentHTML('beforeend', footerHTML_pdf);
    } else {
        viewerContainer.innerHTML = `
            <div style="padding: 1rem 2rem; background: #f7fafc; border-bottom: 1px solid #e2e8f0;">
                <div style="font-size: 1.25rem; font-weight: 700; color: #2d3748; display: flex; align-items: center; gap: 0.75rem;">
                    <i class="fas fa-info-circle"></i> File Preview Not Available
                </div>
            </div>
            <div style="padding: 3rem; text-align: center; color: #4a5568;">
                <i class="fas fa-file" style="font-size: 4rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                <h3 style="margin-bottom: 1rem; color: #2d3748;">Preview not available for ${fileType.toUpperCase()} files</h3>
                <p style="margin-bottom: 2rem;">Click "Open File" below to download and view this document in your preferred application.</p>
                <a href="${filePath}" style="display: inline-flex; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; padding: 1rem 1.5rem; border-radius: 12px; font-weight: 600; font-size: 0.95rem; text-decoration: none; align-items: center; gap: 0.75rem;" download>
                    <i class="fas fa-download"></i> Download ${fileType.toUpperCase()} File
                </a>
            </div>
        `;

        // add footer actions so buttons appear at the bottom of the modal
        const footerHTML_nonpdf = `
            <div style="padding:1.5rem 2rem; border-top:1px solid #e2e8f0; display:flex; justify-content:center; gap:1rem; background:white; border-bottom-left-radius:16px; border-bottom-right-radius:16px;">
                <a href="${filePath}" download style="display:inline-flex; align-items:center; gap:0.75rem; padding:1rem 1.5rem; border-radius:12px; background:linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color:white; text-decoration:none; font-weight:600; max-width:250px;">
                    <i class="fas fa-download"></i> Download ${fileType.toUpperCase()}
                </a>
                <a href="/admin/references/${id}/edit" style="display:inline-flex; align-items:center; gap:0.75rem; padding:1rem 1.5rem; border-radius:12px; background:linear-gradient(135deg, #ffeaa7 0%, #fab1a0 100%); color:white; text-decoration:none; font-weight:600; max-width:200px;">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <button onclick="closeFileModal()" style="display:inline-flex; align-items:center; gap:0.75rem; padding:1rem 1.5rem; border-radius:12px; background:white; border:2px solid #e2e8f0; color:#2d3748; font-weight:600; max-width:200px; cursor:pointer;">
                    <i class="fas fa-times"></i> Close
                </button>
            </div>
        `;
        viewerContainer.insertAdjacentHTML('beforeend', footerHTML_nonpdf);
    }
    
    document.getElementById('fileModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeFileModal() {
    document.getElementById('fileModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

function toggleModalFullscreen() {
    const viewer = document.getElementById('pdfViewerModal');
    const container = viewer.parentElement;
    
    if (!document.fullscreenElement) {
        container.requestFullscreen().then(() => {
            viewer.style.height = '100vh';
        }).catch(err => {
            console.log('Error attempting to enable fullscreen:', err);
        });
    } else {
        document.exitFullscreen().then(() => {
            viewer.style.height = '700px';
        });
    }
}

// Dismiss alert function
function dismissAlert(alertId) {
    const alert = document.getElementById(alertId);
    if (alert) {
        alert.classList.add('alert-fade-out');
        setTimeout(() => {
            alert.remove();
        }, 500);
    }
}

// Close modal when clicking outside
document.getElementById('linkModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeLinkModal();
    }
});

document.getElementById('fileModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeFileModal();
    }
});

document.addEventListener('DOMContentLoaded', function() {
    // Auto-dismiss success and error alerts after 5 seconds
    const successAlert = document.getElementById('successAlert');
    const errorAlert = document.getElementById('errorAlert');
    
    if (successAlert) {
        setTimeout(() => {
            dismissAlert('successAlert');
        }, 5000);
    }
    
    if (errorAlert) {
        setTimeout(() => {
            dismissAlert('errorAlert');
        }, 7000);
    }
    
    // Handle search input Enter key
    const searchInput = document.querySelector('input[name="search"]');
    if (searchInput) {
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                this.form.submit();
            }
        });
    }

    // Handle dropdown change
    const typeSelect = document.querySelector('select[name="type"]');
    if (typeSelect) {
        typeSelect.addEventListener('change', function() {
            this.form.submit();
        });
    }
});

// Delete Modal Functions
let deleteFormToSubmit = null;

function showDeleteModal(button) {
    const form = button.closest('form');
    const refTitle = form.dataset.refTitle;
    deleteFormToSubmit = form;
    
    const message = refTitle ? 
        `Are you sure you want to delete "${refTitle}"? This action cannot be undone.` :
        'Are you sure you want to delete this reference? This action cannot be undone.';
    
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
    const deleteModal = document.getElementById('deleteModal');
    if (deleteModal) {
        deleteModal.addEventListener('click', function(e) {
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
</script>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="modal-overlay">
    <div class="modal-container" style="max-width: 400px;">
        <div style="width: 60px; height: 60px; margin: 0 auto 1.5rem; background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #dc2626; font-size: 1.8rem;">
            <i class="fas fa-trash-alt"></i>
        </div>
        <h3 style="font-size: 1.5rem; font-weight: 700; color: #1f2937; text-align: center; margin-bottom: 0.75rem;">Delete Reference</h3>
        <p id="deleteMessage" style="color: #6b7280; text-align: center; margin-bottom: 2rem; line-height: 1.6;">Are you sure you want to delete this reference? This action cannot be undone.</p>
        <div style="display: flex; gap: 1rem; justify-content: center;">
            <button type="button" onclick="hideDeleteModal()" style="padding: 0.75rem 2rem; border-radius: 10px; font-weight: 600; border: none; cursor: pointer; background: #e5e7eb; color: #374151; transition: all 0.3s ease;">
                Cancel
            </button>
            <button type="button" onclick="confirmDelete()" style="padding: 0.75rem 2rem; border-radius: 10px; font-weight: 600; border: none; cursor: pointer; background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);">
                <i class="fas fa-trash"></i> Delete
            </button>
        </div>
    </div>
</div>

@endsection
