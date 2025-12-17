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

    .form-container {
        max-width: 800px;
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
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
    }

    .header-title i {
        color: rgba(255, 255, 255, 0.9);
        font-size: 2rem;
        flex-shrink: 0;
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

    .file-upload-section {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
        margin-top: 1rem;
    }

    .file-upload-group {
        display: flex;
        flex-direction: column;
    }

    .file-drop-zone {
        border: 3px dashed var(--border-color);
        border-radius: 16px;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s ease;
        cursor: pointer;
        background: var(--bg-light);
        position: relative;
        overflow: hidden;
    }

    .file-drop-zone:hover {
        border-color: var(--primary-color);
        background: var(--white);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .file-drop-zone.dragover {
        border-color: var(--accent-color);
        background: rgba(240, 147, 251, 0.05);
        transform: scale(1.02);
    }

    .file-drop-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
    }

    .file-drop-icon {
        font-size: 3rem;
        color: var(--primary-color);
        margin-bottom: 0.5rem;
    }

    .file-drop-text {
        font-weight: 600;
        color: var(--text-dark);
        font-size: 1.1rem;
    }

    .file-drop-hint {
        color: var(--text-light);
        font-size: 0.9rem;
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
        height: 175px;
        border: 2px dashed var(--border-color);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--bg-light);
        color: var(--text-light);
        font-size: 0.9rem;
        text-align: center;
        overflow: hidden;
        position: relative;
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
        gap: 0.5rem;
    }

    .file-info {
        margin-top: 1rem;
        padding: 1rem;
        background: var(--bg-light);
        border-radius: 8px;
        font-size: 0.9rem;
        color: var(--text-medium);
    }

    .file-info strong {
        color: var(--text-dark);
    }

    .form-actions {
        padding: 2rem 2.5rem;
        background: var(--bg-light);
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
    }

    .btn {
        padding: 1rem 2rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        min-width: 140px;
        justify-content: center;
    }

    .btn-primary {
        background: var(--primary);
        color: white;
        box-shadow: var(--shadow-md);
    }

    .btn-primary:hover {
        transform: translateY(-2px) scale(1.02);
        box-shadow: var(--shadow-xl);
    }

    .btn-secondary {
        background: var(--white);
        color: var(--text-medium);
        border: 2px solid var(--border-color);
        box-shadow: var(--shadow-sm);
    }

    .btn-secondary:hover {
        background: var(--bg-light);
        border-color: var(--text-medium);
        transform: translateY(-1px);
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

    .alert ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .alert li {
        margin-bottom: 0.25rem;
    }

    .progress-bar {
        width: 100%;
        height: 6px;
        background: var(--border-color);
        border-radius: 3px;
        overflow: hidden;
        margin-top: 1rem;
        display: none;
    }

    .progress-fill {
        height: 100%;
        background: var(--primary);
        border-radius: 3px;
        transition: width 0.3s ease;
        width: 0%;
    }

    @media (max-width: 768px) {
        .main-content {
            padding: 1rem;
        }
        
        .header-title {
            font-size: 2rem;
        }
        
        .file-upload-section {
            grid-template-columns: 1fr;
        }
        
        .form-actions {
            flex-direction: column;
        }
        
        .btn {
            width: 100%;
        }
    }
</style>

<main class="main-content">
    <div class="content-container" style="max-width: 850px; margin: 0 auto;">
        <!-- Header Section -->
        <div class="header-section">
            <h1 class="header-title">
                <i class="fas fa-cloud-upload-alt"></i>
                Upload Reference
            </h1>
            <p class="header-subtitle">Add a new document to your research library</p>
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

        @if($errors->any())
            <div class="alert alert-error">
                <i class="fas fa-exclamation-triangle"></i>
                <div>
                    <strong>Please fix the following errors:</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <!-- Form Section -->
        <div class="form-section">
            <form action="{{ route('admin.references.store') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                @csrf
                <div class="form-inner">
                    <div class="form-grid">
                        <!-- Title -->
                        <div class="form-group">
                            <label class="form-label" for="title">
                                <i class="fas fa-heading"></i>
                                Title
                            </label>
                            <input class="form-control" type="text" name="title" id="title" 
                                   value="{{ old('title') }}" 
                                   placeholder="Enter the reference title..." 
                                   required>
                        </div>

                        <!-- Reference Type -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-list"></i>
                                Reference Type
                            </label>
                            <div style="display: flex; gap: 2rem; margin-top: 0.5rem;">
                                <label style="display: flex; align-items: center; gap: 0.5rem; font-weight: 500; cursor: pointer;">
                                    <input type="radio" name="reference_type" value="file" checked onchange="toggleReferenceType()">
                                    <i class="fas fa-file"></i> Upload File
                                </label>
                                <label style="display: flex; align-items: center; gap: 0.5rem; font-weight: 500; cursor: pointer;">
                                    <input type="radio" name="reference_type" value="link" onchange="toggleReferenceType()">
                                    <i class="fas fa-link"></i> Add Link
                                </label>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="form-group">
                            <label class="form-label" for="description">
                                <i class="fas fa-align-left"></i>
                                Description
                            </label>
                            <textarea class="form-control form-textarea" name="description" id="description" 
                                      placeholder="Provide a brief description of the reference content...">{{ old('description') }}</textarea>
                        </div>

                        <!-- URL Field (for links) -->
                        <div class="form-group" id="urlField" style="display: none;">
                            <label class="form-label" for="url">
                                <i class="fas fa-external-link-alt"></i>
                                URL
                            </label>
                            <input class="form-control" type="url" name="url" id="url" 
                                   value="{{ old('url') }}" 
                                   placeholder="https://example.com/article">
                        </div>

                        <!-- File Upload Section -->
                        <div class="file-upload-section" id="fileUploadSection">
                            <!-- Main File Upload -->
                            <div class="file-upload-group">
                                <label class="form-label">
                                    <i class="fas fa-file-upload"></i>
                                    Document File
                                </label>
                                <div class="file-drop-zone" id="fileDropZone">
                                    <input type="file" name="file" id="file" class="file-input" 
                                           accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx" required>
                                    <div class="file-drop-content">
                                        <div class="file-drop-icon">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                        </div>
                                        <div class="file-drop-text">Click or drag file here</div>
                                        <div class="file-drop-hint">PDF, DOC, PPT, XLS (Max: 10MB)</div>
                                    </div>
                                </div>
                                <div class="progress-bar" id="progressBar">
                                    <div class="progress-fill" id="progressFill"></div>
                                </div>
                                <div class="file-info" id="fileInfo" style="display: none;">
                                    <strong>Selected:</strong> <span id="fileName"></span><br>
                                    <strong>Size:</strong> <span id="fileSize"></span><br>
                                    <strong>Type:</strong> <span id="fileType"></span>
                                </div>
                            </div>

                            <!-- Thumbnail Upload -->
                            <div class="file-upload-group" id="thumbnailSection">
                                <label class="form-label">
                                    <i class="fas fa-image"></i>
                                    Thumbnail (Optional)
                                </label>
                                <div class="file-drop-zone" id="thumbnailDropZone">
                                    <input type="file" name="thumbnail" id="thumbnail" class="file-input" 
                                           accept=".jpg,.jpeg,.png,.gif">
                                    <div class="file-drop-content">
                                        <div class="file-drop-icon">
                                            <i class="fas fa-image"></i>
                                        </div>
                                        <div class="file-drop-text">Click or drag image here</div>
                                        <div class="file-drop-hint">JPG, PNG, GIF (Max: 2MB)</div>
                                    </div>
                                </div>
                                <div class="thumbnail-preview" id="thumbnailPreview">
                                    <div class="thumbnail-placeholder">
                                        <i class="fas fa-image" style="font-size: 2rem; color: var(--text-light);"></i>
                                        <span>Thumbnail preview</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Link Thumbnail Section (separate for links) -->
                        <div class="file-upload-section" id="linkThumbnailSection" style="display: none;">
                            <div class="file-upload-group">
                                <label class="form-label">
                                    <i class="fas fa-image"></i>
                                    Thumbnail (Optional)
                                </label>
                                <div class="file-drop-zone" id="linkThumbnailDropZone">
                                    <input type="file" name="thumbnail" id="linkThumbnail" class="file-input" 
                                           accept=".jpg,.jpeg,.png,.gif">
                                    <div class="file-drop-content">
                                        <div class="file-drop-icon">
                                            <i class="fas fa-image"></i>
                                        </div>
                                        <div class="file-drop-text">Click or drag image here</div>
                                        <div class="file-drop-hint">JPG, PNG, GIF (Max: 2MB)</div>
                                    </div>
                                </div>
                                <div class="thumbnail-preview" id="linkThumbnailPreview">
                                    <div class="thumbnail-placeholder">
                                        <i class="fas fa-image" style="font-size: 2rem; color: var(--text-light);"></i>
                                        <span>Thumbnail preview</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('admin.references.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i>
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <i class="fas fa-cloud-upload-alt"></i>
                        Upload Reference
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
// Toggle between file upload and URL input
function toggleReferenceType() {
    const referenceType = document.querySelector('input[name="reference_type"]:checked').value;
    const fileSection = document.getElementById('fileUploadSection');
    const linkThumbnailSection = document.getElementById('linkThumbnailSection');
    const urlField = document.getElementById('urlField');
    const fileInput = document.getElementById('file');
    const urlInput = document.getElementById('url');
    const fileThumbnailInput = document.getElementById('thumbnail');
    const linkThumbnailInput = document.getElementById('linkThumbnail');
    
    if (referenceType === 'file') {
        fileSection.style.display = 'block';
        linkThumbnailSection.style.display = 'none';
        urlField.style.display = 'none';
        fileInput.required = true;
        urlInput.required = false;
        urlInput.value = '';
        // Enable file thumbnail, disable link thumbnail
        fileThumbnailInput.disabled = false;
        linkThumbnailInput.disabled = true;
        linkThumbnailInput.value = '';
    } else {
        fileSection.style.display = 'none';
        linkThumbnailSection.style.display = 'block';
        urlField.style.display = 'block';
        fileInput.required = false;
        urlInput.required = true;
        // Clear file input
        fileInput.value = '';
        document.getElementById('fileInfo').style.display = 'none';
        // Enable link thumbnail, disable file thumbnail
        fileThumbnailInput.disabled = true;
        fileThumbnailInput.value = '';
        linkThumbnailInput.disabled = false;
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // File upload handlers
    const fileInput = document.getElementById('file');
    const fileDropZone = document.getElementById('fileDropZone');
    const fileInfo = document.getElementById('fileInfo');
    const fileName = document.getElementById('fileName');
    const fileSize = document.getElementById('fileSize');
    const fileType = document.getElementById('fileType');
    const progressBar = document.getElementById('progressBar');
    const progressFill = document.getElementById('progressFill');

    // Thumbnail handlers
    const thumbnailInput = document.getElementById('thumbnail');
    const thumbnailDropZone = document.getElementById('thumbnailDropZone');
    const thumbnailPreview = document.getElementById('thumbnailPreview');
    
    // Link thumbnail handlers
    const linkThumbnailInput = document.getElementById('linkThumbnail');
    const linkThumbnailDropZone = document.getElementById('linkThumbnailDropZone');
    const linkThumbnailPreview = document.getElementById('linkThumbnailPreview');

    // Initialize: Enable file thumbnail, disable link thumbnail on page load
    thumbnailInput.disabled = false;
    linkThumbnailInput.disabled = true;

    // File drop zone events
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        fileDropZone.addEventListener(eventName, preventDefaults, false);
        thumbnailDropZone.addEventListener(eventName, preventDefaults, false);
        linkThumbnailDropZone.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    // Highlight drop zone when item is dragged over it
    ['dragenter', 'dragover'].forEach(eventName => {
        fileDropZone.addEventListener(eventName, () => fileDropZone.classList.add('dragover'), false);
        thumbnailDropZone.addEventListener(eventName, () => thumbnailDropZone.classList.add('dragover'), false);
        linkThumbnailDropZone.addEventListener(eventName, () => linkThumbnailDropZone.classList.add('dragover'), false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        fileDropZone.addEventListener(eventName, () => fileDropZone.classList.remove('dragover'), false);
        thumbnailDropZone.addEventListener(eventName, () => thumbnailDropZone.classList.remove('dragover'), false);
        linkThumbnailDropZone.addEventListener(eventName, () => linkThumbnailDropZone.classList.remove('dragover'), false);
    });

    // Handle file drops
    fileDropZone.addEventListener('drop', handleFileDrop, false);
    thumbnailDropZone.addEventListener('drop', handleThumbnailDrop, false);
    linkThumbnailDropZone.addEventListener('drop', handleLinkThumbnailDrop, false);

    function handleFileDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        if (files.length > 0) {
            fileInput.files = files;
            handleFileSelect(files[0]);
        }
    }

    function handleThumbnailDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        if (files.length > 0) {
            thumbnailInput.files = files;
            handleThumbnailSelect(files[0]);
        }
    }

    function handleLinkThumbnailDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        if (files.length > 0) {
            linkThumbnailInput.files = files;
            handleLinkThumbnailSelect(files[0]);
        }
    }

    // Handle file input change
    fileInput.addEventListener('change', function(e) {
        if (e.target.files.length > 0) {
            handleFileSelect(e.target.files[0]);
        }
    });

    thumbnailInput.addEventListener('change', function(e) {
        if (e.target.files.length > 0) {
            handleThumbnailSelect(e.target.files[0]);
        }
    });

    linkThumbnailInput.addEventListener('change', function(e) {
        if (e.target.files.length > 0) {
            handleLinkThumbnailSelect(e.target.files[0]);
        }
    });

    function handleFileSelect(file) {
        fileName.textContent = file.name;
        fileSize.textContent = formatFileSize(file.size);
        fileType.textContent = file.type || 'Unknown';
        fileInfo.style.display = 'block';

        // Update drop zone text
        const dropContent = fileDropZone.querySelector('.file-drop-content');
        dropContent.innerHTML = `
            <div class="file-drop-icon">
                <i class="fas fa-check-circle" style="color: var(--success);"></i>
            </div>
            <div class="file-drop-text" style="color: var(--success);">File selected: ${file.name}</div>
            <div class="file-drop-hint">Click to change file</div>
        `;
    }

    function handleThumbnailSelect(file) {
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                thumbnailPreview.innerHTML = `<img src="${e.target.result}" alt="Thumbnail preview">`;
            };
            reader.readAsDataURL(file);

            // Update drop zone text
            const dropContent = thumbnailDropZone.querySelector('.file-drop-content');
            dropContent.innerHTML = `
                <div class="file-drop-icon">
                    <i class="fas fa-check-circle" style="color: var(--success);"></i>
                </div>
                <div class="file-drop-text" style="color: var(--success);">Image selected</div>
                <div class="file-drop-hint">Click to change image</div>
            `;
        }
    }

    function handleLinkThumbnailSelect(file) {
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                linkThumbnailPreview.innerHTML = `<img src="${e.target.result}" alt="Thumbnail preview">`;
            };
            reader.readAsDataURL(file);

            // Update drop zone text
            const dropContent = linkThumbnailDropZone.querySelector('.file-drop-content');
            dropContent.innerHTML = `
                <div class="file-drop-icon">
                    <i class="fas fa-check-circle" style="color: var(--success);"></i>
                </div>
                <div class="file-drop-text" style="color: var(--success);">Image selected</div>
                <div class="file-drop-hint">Click to change image</div>
            `;
        }
    }

    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    // Form submission with progress
    document.getElementById('uploadForm').addEventListener('submit', function(e) {
        const submitBtn = document.getElementById('submitBtn');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Uploading...';
        submitBtn.disabled = true;
        progressBar.style.display = 'block';

        // Simulate progress (replace with actual upload progress if needed)
        let progress = 0;
        const interval = setInterval(() => {
            progress += 10;
            progressFill.style.width = progress + '%';
            if (progress >= 90) {
                clearInterval(interval);
            }
        }, 100);
    });
});
</script>

@endsection
