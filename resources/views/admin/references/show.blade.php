@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/reference-theme.css') }}">
<style>
    :root {
        --primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --secondary: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --success: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        --warning: linear-gradient(135deg, #ffeaa7 0%, #fab1a0 100%);
        --danger: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
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

    .content-container {
        max-width: 1300px;
        margin: 0 auto;
    }

    .header-section {
        background: var(--white);
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-lg);
        padding: 1.5rem 1.5rem !important;
        margin-bottom: 1.25rem !important;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 3rem;
    }

    .header-info {
        flex: 1;
    }

    .header-title {
        font-size: 1.8rem !important;
        font-weight: 800;
        margin-bottom: 1rem !important;
        line-height: 1.3;
        background: linear-gradient(135deg, #ffffff 0%, #e3f2fd 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .header-meta {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 0.75rem !important;
        opacity: 0.95;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 1rem;
        font-weight: 500;
    }

    .meta-icon {
        width: 20px;
        text-align: center;
        font-size: 1.1rem;
    }

    .header-thumbnail {
        flex-shrink: 0;
        width: 180px;
        height: 135px;
        border-radius: 12px;
        overflow: hidden;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid rgba(255, 255, 255, 0.2);
    }

    .header-thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .thumbnail-placeholder {
        text-align: center;
        color: rgba(255, 255, 255, 0.7);
    }

    .thumbnail-placeholder i {
        font-size: 3rem;
        margin-bottom: 0.5rem;
        display: block;
    }

    .description-section {
        background: var(--white);
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-md);
        padding: 1.25rem 1.5rem !important;
        margin-bottom: 1.25rem !important;
    }

    .description-title {
        font-size: 1.2rem !important;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 0.75rem !important;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .description-content {
        color: var(--text-medium);
        line-height: 1.7;
        font-size: 1.05rem;
    }

    .action-btn {
        width: 100%; /* Make the button/link fill its parent */
        flex-grow: 1; /* Ensure the button inside the form also grows */
        padding: 1rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.95rem;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        white-space: nowrap;
        min-height: 50px;
        text-align: center;
    }

    .btn-view {
        background: var(--success);
        color: white;
    }

    .btn-edit {
        background: var(--warning);
        color: white;
    }

    .btn-delete {
        background: var(--danger);
        color: white;
    }

    .btn-back {
        background: var(--white);
        color: var(--text-dark);
        border: 2px solid var(--border-color);
    }

    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        text-decoration: none;
    }

    .btn-view:hover {
        background: linear-gradient(135deg, #3182ce 0%, #2c5282 100%);
        color: white;
    }

    .btn-edit:hover {
        background: linear-gradient(135deg, #d69e2e 0%, #b7791f 100%);
        color: white;
    }

    .btn-delete:hover {
        background: linear-gradient(135deg, #e53e3e 0%, #c53030 100%);
        color: white;
    }

    .btn-back:hover {
        background: var(--bg-light);
        border-color: var(--text-medium);
        color: var(--text-dark);
    }

    .action-btn:hover {
        transform: translateY(-2px) scale(1.02);
        box-shadow: var(--shadow-lg);
    }

    .viewer-section {
        background: var(--white);
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-lg);
        overflow: hidden;
    }

    .viewer-header {
        padding: 1rem 2rem;
        background: var(--bg-light);
        border-bottom: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1.5rem;
    }

    .viewer-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text-dark);
        display: flex;
        align-items: center;
        gap: 0.75rem;
        flex: 1;
    }

    .viewer-controls {
        display: flex;
        gap: 0.75rem;
    }

    .viewer-control {
        padding: 0.7rem;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        background: var(--white);
        color: var(--text-medium);
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 0.9rem;
    }

    .viewer-control:hover {
        background: var(--bg-light);
        border-color: var(--primary-color);
        color: var(--primary-color);
    }

    .viewer-footer {
        padding: 1.5rem 2rem;
        border-top: 1px solid var(--border-color);
        display: flex;
        justify-content: center;
        gap: 1rem;
        background: var(--white);
        border-bottom-left-radius: var(--border-radius);
        border-bottom-right-radius: var(--border-radius);
    }

    .viewer-iframe {
        width: 100%;
        height: 700px;
        border: none;
        background: #f8f9fa;
    }

    .alert {
        padding: 1.5rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-weight: 500;
        box-shadow: var(--shadow-sm);
    }

    .alert-success {
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        border: 1px solid #b8dacc;
        color: #155724;
    }

    .alert-error {
        background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
        border: 1px solid #f1aeb5;
        color: #721c24;
    }

    @media (max-width: 768px) {
        .main-content {
            padding: 1rem;
        }
        
        .header-section {
            padding: 2rem 1.5rem;
        }
        
        .header-content {
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 2rem;
        }
        
        .header-thumbnail {
            width: 100%;
            max-width: 250px;
            height: 120px;
        }
        
        .header-title {
            font-size: 1.8rem;
        }
        
        .header-meta {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        .description-section {
            padding: 1.5rem;
        }
        
        .actions-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        .action-btn {
            padding: 1.25rem 1rem;
            font-size: 0.9rem;
        }
        
        .viewer-iframe {
            height: 500px;
        }
        
        .viewer-header {
            padding: 1rem 1.5rem;
            flex-direction: column;
            align-items: stretch;
            gap: 1rem;
        }
        
        .viewer-controls {
            justify-content: center;
        }
    }
</style>

<main class="main-content">
    <div class="content-container" style="max-width: 1300px; margin: 0 auto;">
        <!-- Alert Messages -->
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i>
                {{ session('error') }}
            </div>
        @endif

        <!-- Header Section -->
        <div class="header-section">
            <div class="header-content">
                <div class="header-info">
                    <h1 class="header-title">{{ $reference->title }}</h1>
                    
                    <div class="header-meta">
                        <div class="meta-item">
                            <i class="fas fa-user meta-icon"></i>
                            <span>{{ optional($reference->uploader)->name ?? 'Unknown' }}</span>
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
                            <i class="fas fa-file-alt meta-icon"></i>
                            <span>{{ strtoupper($reference->file_type) }}</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-weight-hanging meta-icon"></i>
                            <span>{{ $reference->file_size_human }}</span>
                        </div>
                    </div>
                </div>

                <div class="header-thumbnail">
                    @if($reference->thumbnail_path)
                        <img src="{{ asset('storage/' . $reference->thumbnail_path) }}" 
                             alt="{{ $reference->title }}" loading="lazy">
                    @else
                        <div class="thumbnail-placeholder">
                            @switch($reference->file_type)
                                @case('pdf')
                                    <i class="fas fa-file-pdf"></i>
                                    @break
                                @case('doc')
                                @case('docx')
                                    <i class="fas fa-file-word"></i>
                                    @break
                                @case('ppt')
                                @case('pptx')
                                    <i class="fas fa-file-powerpoint"></i>
                                    @break
                                @case('xls')
                                @case('xlsx')
                                    <i class="fas fa-file-excel"></i>
                                    @break
                                @default
                                    <i class="fas fa-file"></i>
                            @endswitch
                            <small>No Thumbnail</small>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Description Section -->
        @if($reference->description)
            <div class="description-section">
                <h2 class="description-title">
                    <i class="fas fa-align-left"></i>
                    Description
                </h2>
                <div class="description-content">
                    {!! nl2br(e($reference->description)) !!}
                </div>
            </div>
        @endif

        <!-- PDF Viewer Section -->
        @if($reference->file_type === 'pdf')
            <div class="viewer-section">
                <div class="viewer-header">
                    <div class="viewer-title">
                        <i class="fas fa-file-pdf"></i>
                        PDF Viewer
                    </div>
                    <div class="viewer-controls">
                        <button class="viewer-control" onclick="toggleFullscreen()" title="Toggle Fullscreen">
                            <i class="fas fa-expand"></i>
                        </button>
                        <a href="{{ asset('storage/' . $reference->file_path) }}" 
                           class="viewer-control" target="_blank" title="Open in New Tab">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>
                </div>
                <iframe src="{{ asset('vendor/pdfjs/web/viewer.html') }}?file={{ urlencode(route('pdf.serve', $reference)) }}" 
                        class="viewer-iframe" 
                        title="PDF Viewer - {{ $reference->title }}"
                        id="pdfViewer">
                </iframe>
                <div class="viewer-footer">
                    <a href="{{ route('admin.references.edit', $reference) }}" 
                       class="action-btn btn-edit" 
                       style="display: inline-flex; max-width: 200px;">
                        <i class="fas fa-edit"></i>
                        Edit Reference
                    </a>
                    <a href="{{ route('admin.references.index') }}" 
                       class="action-btn btn-back" 
                       style="display: inline-flex; max-width: 200px;">
                        <i class="fas fa-times"></i>
                        Close
                    </a>
                </div>
            </div>
        @else
            <div class="viewer-section">
                <div class="viewer-header">
                    <div class="viewer-title">
                        <i class="fas fa-info-circle"></i>
                        File Preview Not Available
                    </div>
                </div>
                <div style="padding: 3rem 2rem; text-align: center; color: var(--text-medium);">
                    <i class="fas fa-file" style="font-size: 4rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                    <h3 style="margin-bottom: 1rem; color: var(--text-dark);">Preview not available for {{ strtoupper($reference->file_type) }} files</h3>
                    <p>You can download the file to view it on your device.</p>
                </div>
                <div class="viewer-footer">
                    <a href="{{ asset('storage/' . $reference->file_path) }}" 
                       class="action-btn btn-view" 
                       style="display: inline-flex; max-width: 250px;" 
                       download>
                        <i class="fas fa-download"></i>
                        Download {{ strtoupper($reference->file_type) }}
                    </a>
                    <a href="{{ route('admin.references.edit', $reference) }}" 
                       class="action-btn btn-edit" 
                       style="display: inline-flex; max-width: 200px;">
                        <i class="fas fa-edit"></i>
                        Edit
                    </a>
                    <a href="{{ route('admin.references.index') }}" 
                       class="action-btn btn-back" 
                       style="display: inline-flex; max-width: 200px;">
                        <i class="fas fa-times"></i>
                        Close
                    </a>
                </div>
            </div>
        @endif
    </div>
</main>

<script>
function toggleFullscreen() {
    const viewer = document.getElementById('pdfViewer');
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

// Handle fullscreen change events
document.addEventListener('fullscreenchange', function() {
    const viewer = document.getElementById('pdfViewer');
    if (!document.fullscreenElement) {
        viewer.style.height = '700px';
    }
});

// Auto-resize viewer on window resize
window.addEventListener('resize', function() {
    const viewer = document.getElementById('pdfViewer');
    if (window.innerWidth <= 768) {
        viewer.style.height = '500px';
    } else if (!document.fullscreenElement) {
        viewer.style.height = '700px';
    }
});


</script>
@endsection
