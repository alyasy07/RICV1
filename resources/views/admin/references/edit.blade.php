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

    .form-container {
        max-width: 900px;
        margin: 0 auto;
    }

    .header-section {
        background: var(--white);
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-lg);
        padding: 2rem;
        margin-bottom: 2rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        text-align: center;
    }

    .header-title {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
        background: linear-gradient(135deg, #ffffff 0%, #e3f2fd 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .header-subtitle {
        font-size: 1.2rem;
        opacity: 0.9;
        font-weight: 400;
    }

    .form-section {
        background: var(--white);
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-lg);
        overflow: hidden;
    }

    .form-inner {
        padding: 2.5rem;
    }

    .form-grid {
        display: grid;
        gap: 2rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-label {
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 0.75rem;
        font-size: 1rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        min-height: 1.5em;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-control {
        padding: 1rem 1.25rem;
        border: 2px solid var(--border-color);
        border-radius: 12px;
        font-size: 1rem;
        background: var(--bg-light);
        color: var(--text-dark);
        transition: all 0.3s ease;
        font-family: inherit;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary-color);
        background: var(--white);
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        transform: translateY(-1px);
    }

    .form-textarea {
        resize: vertical;
        min-height: 120px;
    }

    .current-file-section {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
        padding: 1.5rem;
        background: var(--bg-light);
        border-radius: 12px;
        margin-bottom: 2rem;
    }

    .link-preview-content {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 0;
        width: 100%;
        height: 100%;
    }

    .link-icon {
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 50px;
        background: rgba(102, 126, 234, 0.1);
        border-radius: 8px;
        margin-right: 1rem;
    }

    .link-info {
        flex: 1;
        min-width: 0;
    }

    .link-url {
        font-family: monospace;
    }

    .current-file-info {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .current-file-preview {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        border: 2px dashed var(--border-color);
        border-radius: 12px;
        background: var(--white);
        min-height: 180px;
    }

    .current-file-preview .link-preview-content {
        flex-direction: row;
        align-items: center;
        justify-content: flex-start;
        width: 100%;
        padding: 1rem;
    }

    .file-icon {
        font-size: 3rem;
        margin-bottom: 0.5rem;
    }

    .current-thumbnail {
        width: 100%;
        height: 175px;
        border-radius: 12px;
        object-fit: cover;
        box-shadow: var(--shadow-md);
    }

    .thumbnail-placeholder {
        width: 100%;
        height: 175px;
        border: 2px dashed var(--border-color);
        border-radius: 12px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: var(--bg-light);
        color: var(--text-light);
    }

    .file-upload-section {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
        margin-top: 1rem;
        align-items: start;
    }

    .thumbnail-upload-section {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
        margin-top: 1rem;
        align-items: start;
    }

    .file-upload-group {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .thumbnail-preview-container {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .file-drop-zone {
        border: 2px dashed var(--border-color);
        border-radius: 12px;
        padding: 1rem;
        text-align: center;
        transition: all 0.3s ease;
        cursor: pointer;
        background: var(--bg-light);
        position: relative;
        overflow: hidden;
        height: 180px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .file-drop-zone:hover {
        border-color: var(--primary-color);
        background: var(--white);
        transform: translateY(-1px);
        box-shadow: var(--shadow-sm);
    }

    .file-drop-zone.dragover {
        border-color: var(--accent-color);
        background: rgba(240, 147, 251, 0.05);
        transform: scale(1.01);
    }

    .file-drop-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        width: 100%;
        height: 100%;
    }

    .file-drop-icon {
        font-size: 2rem;
        color: var(--primary-color);
        margin-bottom: 0.25rem;
    }

    .file-drop-text {
        font-weight: 600;
        color: var(--text-dark);
        font-size: 0.95rem;
    }

    .file-drop-hint {
        color: var(--text-light);
        font-size: 0.8rem;
    }

    .file-input {
        position: absolute;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    .thumbnail-preview {
        width: 100%;
        height: 180px;
        border: 2px solid var(--border-color);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--white);
        color: var(--text-light);
        font-size: 0.8rem;
        text-align: center;
        overflow: hidden;
        position: relative;
        box-shadow: var(--shadow-sm);
    }

    .thumbnail-preview-small {
        width: 100%;
        height: 180px;
        border: 2px solid var(--border-color);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--white);
        color: var(--text-light);
        font-size: 0.8rem;
        text-align: center;
        overflow: hidden;
        position: relative;
        box-shadow: var(--shadow-sm);
    }

    .thumbnail-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 10px;
    }

    .thumbnail-placeholder {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        height: 100%;
        width: 100%;
    }

    .thumbnail-placeholder i {
        font-size: 1.5rem;
        color: var(--text-light);
    }

    .thumbnail-placeholder span {
        font-size: 0.75rem;
        color: var(--text-light);
        text-align: center;
    }

    .form-actions {
        padding: 2rem 2.5rem;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-top: 1px solid var(--border-color);
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        border-radius: 0 0 16px 16px;
        margin-top: 1rem;
    }

    .btn {
        padding: 0.875rem 1.75rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.95rem;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.625rem;
        text-decoration: none;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        min-width: 130px;
        justify-content: center;
        white-space: nowrap;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        position: relative;
        overflow: hidden;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        border: 1px solid transparent;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        text-decoration: none;
        color: white;
    }

    .btn-primary:active {
        transform: translateY(0);
        box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
    }

    .btn-secondary {
        background: var(--white);
        color: var(--text-dark);
        border: 2px solid var(--border-color);
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .btn-secondary:hover {
        background: #f8fafc;
        border-color: #94a3b8;
        color: var(--text-dark);
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        text-decoration: none;
    }

    .btn-secondary:active {
        transform: translateY(0);
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    .btn svg, .btn i {
        width: 1rem;
        height: 1rem;
        flex-shrink: 0;
    }

    .btn:disabled {
        opacity: 0.7;
        cursor: not-allowed;
        transform: none !important;
    }

    .btn:disabled:hover {
        transform: none !important;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1) !important;
    }

    /* Loading spinner animation */
    .fa-spinner {
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
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

    .error-message {
        color: #e53e3e;
        font-size: 0.875rem;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    @media (max-width: 768px) {
        .main-content {
            padding: 1rem;
        }
        
        .header-title {
            font-size: 2rem;
        }
        
        .current-file-section,
        .file-upload-section,
        .thumbnail-upload-section {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        .file-drop-zone {
            min-height: 100px;
            max-height: 120px;
            padding: 1rem;
        }
        
        .file-drop-zone {
            height: 160px;
            padding: 0.75rem;
        }
        
        .thumbnail-preview,
        .thumbnail-preview-small {
            height: 160px;
            width: 100%;
            margin: 0.5rem 0;
        }
        
        .form-actions {
            flex-direction: column;
            gap: 1rem;
            padding: 1.5rem;
        }
        
        .btn {
            width: 100%;
            justify-content: center;
            min-width: auto;
            padding: 1rem 1.5rem;
        }
        
        .btn-secondary {
            order: 2;
        }
        
        .btn-primary {
            order: 1;
        }
    }
</style>

<main class="main-content">
    <div class="content-container" style="max-width: 850px; margin: 0 auto;">
        <!-- Header Section -->
        <div class="header-section">
            <h1 class="header-title">
                <i class="fas fa-edit"></i>
                Edit Reference
            </h1>
            <p class="header-subtitle">Update your reference details and files</p>
        </div>

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

        <!-- Current Files Section -->
        <div class="current-file-section">
            <div class="current-file-info">
                @if($reference->reference_type === 'link')
                    <h3 style="color: var(--text-dark); font-weight: 700; margin-bottom: 1rem;">
                        <i class="fas fa-external-link-alt"></i> Current Link
                    </h3>
                    <div class="current-file-preview">
                        <div class="link-preview-content">
                            <div class="link-icon">
                                <i class="fas fa-external-link-alt" style="color: #667eea; font-size: 2rem;"></i>
                            </div>
                            <div class="link-info">
                                <strong style="color: var(--text-dark); font-size: 1rem;">Link Reference</strong>
                                <div class="link-url" style="margin-top: 0.5rem;">
                                    <small style="word-break: break-all; color: var(--text-medium); line-height: 1.4;">{{ $reference->url }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <h3 style="color: var(--text-dark); font-weight: 700; margin-bottom: 1rem;">
                        <i class="fas fa-file"></i> Current File
                    </h3>
                    <div class="current-file-preview">
                        @switch($reference->file_type)
                            @case('pdf')
                                <i class="fas fa-file-pdf file-icon" style="color: #e53e3e;"></i>
                                @break
                            @case('doc')
                            @case('docx')
                                <i class="fas fa-file-word file-icon" style="color: #2b6cb0;"></i>
                                @break
                            @case('ppt')
                            @case('pptx')
                                <i class="fas fa-file-powerpoint file-icon" style="color: #d69e2e;"></i>
                                @break
                            @case('xls')
                            @case('xlsx')
                                <i class="fas fa-file-excel file-icon" style="color: #38a169;"></i>
                                @break
                            @default
                                <i class="fas fa-file file-icon" style="color: #718096;"></i>
                        @endswitch
                        <div style="text-align: center; color: var(--text-medium);">
                            <strong>{{ basename($reference->file_path ?? 'No file') }}</strong><br>
                            <small>{{ $reference->file_size_human ?? 'Unknown size' }}</small>
                        </div>
                    </div>
                @endif
            </div>
            
            <div class="current-file-info">
                <h3 style="color: var(--text-dark); font-weight: 700; margin-bottom: 1rem;">
                    <i class="fas fa-image"></i> Current Thumbnail
                </h3>
                @if($reference->thumbnail_path)
                    <img src="{{ asset('storage/' . $reference->thumbnail_path) }}" 
                         alt="Current thumbnail" class="current-thumbnail">
                @else
                    <div class="thumbnail-placeholder">
                        <i class="fas fa-image" style="font-size: 2rem;"></i>
                        <span>No thumbnail</span>
                    </div>
                @endif
            </div>
        </div>

        <!-- Form Section -->
        <div class="form-section">
            <form action="{{ route('admin.references.update', $reference) }}" method="POST" enctype="multipart/form-data" id="updateForm">
                @csrf
                @method('PUT')
                <div class="form-inner">
                    <div class="form-grid">
                        <!-- Title -->
                        <div class="form-group">
                            <label class="form-label" for="title">
                                <i class="fas fa-heading"></i>
                                Title
                            </label>
                            <input class="form-control" type="text" name="title" id="title" 
                                   value="{{ old('title', $reference->title) }}" 
                                   placeholder="Enter the reference title..." 
                                   required>
                            @error('title')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="form-group">
                            <label class="form-label" for="description">
                                <i class="fas fa-align-left"></i>
                                Description
                            </label>
                            <textarea class="form-control form-textarea" name="description" id="description" 
                                      placeholder="Provide a brief description of the reference content...">{{ old('description', $reference->description) }}</textarea>
                            @error('description')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        @if($reference->reference_type === 'link')
                        <!-- URL Field (for links) -->
                        <div class="form-group">
                            <label class="form-label" for="url">
                                <i class="fas fa-external-link-alt"></i>
                                URL
                            </label>
                            <input class="form-control" type="url" name="url" id="url" 
                                   value="{{ old('url', $reference->url) }}" 
                                   placeholder="https://example.com/article"
                                   required>
                            @error('url')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        @endif

                        @if($reference->reference_type === 'file')
                        <!-- File Upload Section (only for files) -->
                        <div class="file-upload-section">
                            <!-- Replace File Upload -->
                            <div class="file-upload-group">
                                <label class="form-label">
                                    <i class="fas fa-file-upload"></i>
                                    Replace Document (Optional)
                                </label>
                                <div class="file-drop-zone" id="fileDropZone">
                                    <input type="file" name="file" id="file" class="file-input" 
                                           accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx">
                                    <div class="file-drop-content">
                                        <div class="file-drop-icon">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                        </div>
                                        <div class="file-drop-text">Click or drag new file here</div>
                                        <div class="file-drop-hint">PDF, DOC, PPT, XLS (Max: 10MB)</div>
                                    </div>
                                </div>
                                @error('file')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Replace Thumbnail Upload -->
                            <div class="thumbnail-upload-section">
                                <div class="file-upload-group">
                                    <label class="form-label">
                                        <i class="fas fa-image"></i>
                                        Replace Thumbnail (Optional)
                                    </label>
                                    <div class="file-drop-zone" id="thumbnailDropZone">
                                        <input type="file" name="thumbnail" id="thumbnail" class="file-input" 
                                               accept=".jpg,.jpeg,.png,.gif">
                                        <div class="file-drop-content">
                                            <div class="file-drop-icon">
                                                <i class="fas fa-image"></i>
                                            </div>
                                            <div class="file-drop-text">Click or drag new image here</div>
                                            <div class="file-drop-hint">JPG, PNG, GIF (Max: 2MB)</div>
                                        </div>
                                    </div>
                                    @error('thumbnail')
                                        <div class="error-message">
                                            <i class="fas fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="thumbnail-preview-container">
                                    <label class="form-label">Preview (Actual Size)</label>
                                    <div class="thumbnail-preview" id="thumbnailPreview">
                                        @if($reference->thumbnail_path)
                                            <img src="{{ asset('storage/' . $reference->thumbnail_path) }}" alt="Current thumbnail" id="currentThumbnail">
                                        @else
                                            <div class="thumbnail-placeholder">
                                                <i class="fas fa-image" style="font-size: 1.5rem; color: var(--text-light);"></i>
                                                <span>No thumbnail</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <!-- Thumbnail Upload Section (for links) -->
                        <div class="thumbnail-upload-section">
                            <div class="file-upload-group">
                                <label class="form-label">
                                    <i class="fas fa-image"></i>
                                    Replace Thumbnail (Optional)
                                </label>
                                <div class="file-drop-zone" id="thumbnailDropZoneLink">
                                    <input type="file" name="thumbnail" id="thumbnailLink" class="file-input" 
                                           accept=".jpg,.jpeg,.png,.gif">
                                    <div class="file-drop-content">
                                        <div class="file-drop-icon">
                                            <i class="fas fa-image"></i>
                                        </div>
                                        <div class="file-drop-text">Click or drag new image here</div>
                                        <div class="file-drop-hint">JPG, PNG, GIF (Max: 2MB)</div>
                                    </div>
                                </div>
                                @error('thumbnail')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="thumbnail-preview-container">
                                <label class="form-label">Preview (Actual Size)</label>
                                <div class="thumbnail-preview-small" id="thumbnailPreviewLink">
                                    @if($reference->thumbnail_path)
                                        <img src="{{ asset('storage/' . $reference->thumbnail_path) }}" alt="Current thumbnail" id="currentThumbnailLink">
                                    @else
                                        <div class="thumbnail-placeholder">
                                            <i class="fas fa-image" style="font-size: 1.5rem; color: var(--text-light);"></i>
                                            <span>No thumbnail</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('admin.references.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i>
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <i class="fas fa-save"></i>
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // File and thumbnail handlers
    const fileInput = document.getElementById('file');
    const fileDropZone = document.getElementById('fileDropZone');
    
    // Thumbnail handlers
    const thumbnailInput = document.getElementById('thumbnail');
    const thumbnailInputLink = document.getElementById('thumbnailLink');
    const thumbnailDropZone = document.getElementById('thumbnailDropZone');
    const thumbnailDropZoneLink = document.getElementById('thumbnailDropZoneLink');
    const thumbnailPreview = document.getElementById('thumbnailPreview');
    const thumbnailPreviewLink = document.getElementById('thumbnailPreviewLink');

    // File drop zone events
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        if (fileDropZone) fileDropZone.addEventListener(eventName, preventDefaults, false);
        if (thumbnailDropZone) thumbnailDropZone.addEventListener(eventName, preventDefaults, false);
        if (thumbnailDropZoneLink) thumbnailDropZoneLink.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    // Highlight drop zone when item is dragged over it
    ['dragenter', 'dragover'].forEach(eventName => {
        if (fileDropZone) fileDropZone.addEventListener(eventName, () => fileDropZone.classList.add('dragover'), false);
        if (thumbnailDropZone) thumbnailDropZone.addEventListener(eventName, () => thumbnailDropZone.classList.add('dragover'), false);
        if (thumbnailDropZoneLink) thumbnailDropZoneLink.addEventListener(eventName, () => thumbnailDropZoneLink.classList.add('dragover'), false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        if (fileDropZone) fileDropZone.addEventListener(eventName, () => fileDropZone.classList.remove('dragover'), false);
        if (thumbnailDropZone) thumbnailDropZone.addEventListener(eventName, () => thumbnailDropZone.classList.remove('dragover'), false);
        if (thumbnailDropZoneLink) thumbnailDropZoneLink.addEventListener(eventName, () => thumbnailDropZoneLink.classList.remove('dragover'), false);
    });

    // Handle file drops
    if (fileDropZone) fileDropZone.addEventListener('drop', handleFileDrop, false);
    if (thumbnailDropZone) thumbnailDropZone.addEventListener('drop', handleThumbnailDrop, false);
    if (thumbnailDropZoneLink) thumbnailDropZoneLink.addEventListener('drop', handleThumbnailDrop, false);

    function handleFileDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        if (files.length > 0 && fileInput) {
            fileInput.files = files;
            handleFileSelect(files[0]);
        }
    }

    function handleThumbnailDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        if (files.length > 0) {
            // Determine which thumbnail input to use
            const targetInput = thumbnailInput || thumbnailInputLink;
            if (targetInput) {
                targetInput.files = files;
                handleThumbnailSelect(files[0]);
            }
        }
    }

    // Handle file input change
    if (fileInput) {
        fileInput.addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                handleFileSelect(e.target.files[0]);
            }
        });
    }

    if (thumbnailInput) {
        thumbnailInput.addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                handleThumbnailSelect(e.target.files[0]);
            }
        });
    }

    if (thumbnailInputLink) {
        thumbnailInputLink.addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                handleThumbnailSelect(e.target.files[0]);
            }
        });
    }

    function handleFileSelect(file) {
        // Update drop zone text
        const dropContent = fileDropZone.querySelector('.file-drop-content');
        dropContent.innerHTML = `
            <div class="file-drop-icon">
                <i class="fas fa-check-circle" style="color: var(--primary-color);"></i>
            </div>
            <div class="file-drop-text" style="color: var(--primary-color);">New file selected: ${file.name}</div>
            <div class="file-drop-hint">Click to change file</div>
        `;
    }

    function handleThumbnailSelect(file) {
        console.log('Thumbnail file selected:', file.name, file.type);
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                console.log('Image loaded, updating preview');
                // Update both preview containers
                const thumbnailPreview = document.getElementById('thumbnailPreview');
                const thumbnailPreviewLink = document.getElementById('thumbnailPreviewLink');
                
                const imgHTML = `<img src="${e.target.result}" alt="New thumbnail preview" style="width: 100%; height: 100%; object-fit: cover; border-radius: 10px;">`;
                
                if (thumbnailPreview) {
                    console.log('Updating thumbnailPreview');
                    thumbnailPreview.innerHTML = imgHTML;
                }
                if (thumbnailPreviewLink) {
                    console.log('Updating thumbnailPreviewLink');
                    thumbnailPreviewLink.innerHTML = imgHTML;
                }
            };
            reader.readAsDataURL(file);

            // Update drop zone text for both possible drop zones
            const dropZones = [
                document.getElementById('thumbnailDropZone'),
                document.getElementById('thumbnailDropZoneLink')
            ];
            
            dropZones.forEach(dropZone => {
                if (dropZone) {
                    const dropContent = dropZone.querySelector('.file-drop-content');
                    if (dropContent) {
                        dropContent.innerHTML = `
                            <div class="file-drop-icon">
                                <i class="fas fa-check-circle" style="color: var(--primary-color);"></i>
                            </div>
                            <div class="file-drop-text" style="color: var(--primary-color);">New image selected</div>
                            <div class="file-drop-hint">Click to change image</div>
                        `;
                    }
                }
            });
        }
    }

    // Form submission
    document.getElementById('updateForm').addEventListener('submit', function(e) {
        const submitBtn = document.getElementById('submitBtn');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
        submitBtn.disabled = true;
    });
});
</script>
@endsection
