@extends('layouts.app')

@section('content')
<style>
        :root {
            --primary-color: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-light: #3b82f6;
            --primary-bg: #eff6ff;
            --accent-color: #1e40af;
            --text-dark: #1e293b;
            --text-light: #64748b;
            --white: #ffffff;
            --light-gray: #f8fafc;
            --border-color: #e2e8f0;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f1f5f9;
            color: var(--text-dark);
            line-height: 1.6;
        }

        /* Header Styles */
        .admin-header {
            background: var(--white);
            box-shadow: var(--shadow);
            padding: 1rem 2rem;
            position: sticky;
            top: 0;
            z-index: 100;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .nav-links {
            display: flex;
            gap: 1.5rem;
        }

        .nav-link {
            color: var(--text-light);
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 0;
            transition: color 0.2s;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--primary-color);
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        /* Main Content */
        .main-content {
            padding: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Alert Styles */
        .alert {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            box-shadow: var(--shadow);
        }

        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            border-left: 4px solid #10b981;
        }

        .alert-icon {
            margin-right: 0.75rem;
            font-size: 1.25rem;
        }

        .alert-message {
            flex: 1;
        }

        .alert-dismiss {
            cursor: pointer;
            padding: 0.25rem;
            border-radius: 4px;
            transition: background-color 0.2s;
        }

        .alert-dismiss:hover {
            background-color: rgba(0, 0, 0, 0.1);
        }

        /* Section Styles */
        .content-section {
            background: var(--white);
            border-radius: 12px;
            box-shadow: var(--shadow);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border-color);
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .section-title i {
            color: var(--primary-color);
        }

        .header-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        /* Button Styles */
        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: var(--primary-color);
            color: var(--white);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .btn-outline {
            background: transparent;
            color: var(--text-dark);
            border: 1px solid var(--border-color);
        }

        .btn-outline:hover {
            background: var(--light-gray);
        }

        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }

        /* Filter Bar */
        .filter-bar {
            display: flex;
            gap: 1rem;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: var(--light-gray);
            border-radius: 8px;
        }

        .filter-label {
            font-weight: 500;
            color: var(--text-dark);
            font-size: 0.95rem;
        }

        .filter-select {
            padding: 0.6rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            background: var(--white);
            font-size: 1rem;
            min-width: 140px;
            color: var(--text-dark);
            cursor: pointer;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .filter-select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }

        .search-input {
            padding: 0.6rem 1.2rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            background: var(--white);
            font-size: 1rem;
            color: var(--text-dark);
            min-width: 220px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }

        /* Material Grid */
        .material-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .material-card {
            background: var(--white);
            border-radius: 12px;
            box-shadow: var(--shadow);
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .material-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .material-thumbnail {
            position: relative;
            height: 160px;
            overflow: hidden;
            background: var(--primary-bg);
        }

        .material-thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .material-thumbnail-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            font-size: 1.5rem;
        }

        .material-thumbnail-placeholder span {
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }

        .video-placeholder {
            background: #dbeafe;
        }

        .pdf-placeholder {
            background: #fee2e2;
        }

        .link-placeholder {
            background: #fef3c7;
        }

        .material-type {
            position: absolute;
            top: 0.75rem;
            left: 0.75rem;
            background: var(--primary-color);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .video-duration {
            position: absolute;
            bottom: 0.75rem;
            right: 0.75rem;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.8rem;
        }

        .material-content {
            padding: 1.25rem;
        }

        .material-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
            color: var(--text-dark);
        }

        .material-class {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .material-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 1.25rem;
            border-top: 1px solid var(--border-color);
            background: var(--light-gray);
        }

        .material-stats {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .material-stat {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            color: var(--text-light);
            font-size: 0.85rem;
        }

        .material-actions {
            display: flex;
            gap: 0.5rem;
        }

        /* Empty State */
        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 3rem 2rem;
            color: var(--text-light);
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: var(--border-color);
        }

        /* Pagination */
        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border-color);
        }

        .pagination-info {
            font-size: 0.95rem;
            color: var(--text-light);
        }

        .pagination-nav {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .pagination-nav-btn {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 500;
            background: var(--light-gray);
            color: var(--text-dark);
            border: 1px solid var(--border-color);
            cursor: pointer;
            font-size: 0.9rem;
            transition: background 0.2s, box-shadow 0.2s;
        }

        .pagination-nav-btn:hover {
            background: var(--border-color);
        }

        .pagination-nav-btn:disabled {
            background: #f9f9f9;
            color: #b0b0b0;
            cursor: not-allowed;
        }

        .pagination {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .pagination li {
            margin: 0;
        }

        .pagination a {
            display: block;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 500;
            background: var(--light-gray);
            color: var(--text-dark);
            text-decoration: none;
            transition: background 0.2s, box-shadow 0.2s;
        }

        .pagination a:hover {
            background: var(--border-color);
        }

        .pagination li.active span {
            display: block;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            background: var(--primary-color);
            color: var(--white);
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: var(--white);
            border-radius: 12px;
            box-shadow: var(--shadow-lg);
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        .close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--text-light);
            transition: color 0.2s;
        }

        .close:hover {
            color: var(--text-dark);
        }

        .modal-body {
            padding: 1.5rem;
        }

        .modal-footer {
            padding: 1.5rem;
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--text-dark);
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }

        .file-input-wrapper {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .file-input {
            position: absolute;
            left: -9999px;
        }

        .file-input-label {
            display: block;
            padding: 0.75rem 1rem;
            border: 1px dashed var(--border-color);
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: background 0.2s, border-color 0.2s;
        }

        .file-input-label:hover {
            background: var(--light-gray);
            border-color: var(--primary-color);
        }

        .file-name {
            margin-top: 0.5rem;
            font-size: 0.9rem;
            color: var(--text-light);
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
        }

        .confirm-modal.active {
            display: flex;
            opacity: 1;
        }

        .confirm-modal-content {
            background: var(--white);
            border-radius: 12px;
            box-shadow: var(--shadow-lg);
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
            color: var(--text-dark);
            margin-bottom: 0.75rem;
        }

        .confirm-modal-text {
            color: var(--text-light);
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
            border-radius: 8px;
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
        }

        .btn-confirm-delete:hover {
            background: #dc2626;
        }

        .btn-confirm-cancel {
            background: var(--light-gray);
            color: var(--text-dark);
            border: 1px solid var(--border-color);
        }

        .btn-confirm-cancel:hover {
            background: var(--border-color);
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .material-grid {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .admin-header {
                padding: 1rem;
                flex-direction: column;
                gap: 1rem;
            }
            
            .header-left, .header-right {
                width: 100%;
                justify-content: space-between;
            }
            
            .main-content {
                padding: 1rem;
            }
            
            .section-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .header-actions {
                width: 100%;
                justify-content: space-between;
            }
            
            .filter-bar {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.8rem;
            }
            
            .search-input, .filter-select {
                width: 100%;
                min-width: unset;
            }
            
            .pagination-container {
                flex-direction: column;
                gap: 1rem;
            }
            
            .pagination-nav {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .material-grid {
                grid-template-columns: 1fr;
            }
            
            .material-footer {
                flex-direction: column;
                gap: 0.75rem;
                align-items: flex-start;
            }
            
            .material-actions {
                width: 100%;
                justify-content: flex-end;
            }
        }
    </style>





<main class="main-content">
    <section class="content-section">
        <div class="section-header">
            <h2 class="section-title">
                References
            </h2>
        </div>
        <form method="GET" action="{{ route('admin.references.index') }}" class="filter-bar">
            <span class="filter-label">Filter by:</span>
            <select class="filter-select" name="type" onchange="this.form.submit()">
                <option value="all">All Types</option>
                <option value="pdf">PDFs</option>
                <option value="link">Links</option>
            </select>
            <input type="text" class="search-input" name="search" placeholder="Search references..." value="{{ request('search') }}" onkeyup="if(event.key==='Enter'){this.form.submit();}">
            <a href="{{ route('admin.references.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Add Reference
            </a>
        </form>
        <div class="material-grid">
            @forelse($references as $reference)
            <div class="material-card">
                <div class="material-thumbnail">
                    <div class="material-thumbnail-placeholder {{ $reference->type == 'pdf' ? 'pdf-placeholder' : ($reference->type == 'link' ? 'link-placeholder' : 'video-placeholder') }}">
                        <i class="fas fa-{{ $reference->type == 'pdf' ? 'file-pdf' : ($reference->type == 'link' ? 'link' : 'video') }}"></i>
                        <span>{{ ucfirst($reference->type) }}</span>
                    </div>
                    <span class="material-type">{{ ucfirst($reference->type) }}</span>
                </div>
                <div class="material-content">
                    <h3 class="material-title">{{ $reference->title }}</h3>
                    <div class="material-class">
                        <i class="fas fa-book"></i>
                        {{ $reference->category ?? 'Research' }}
                    </div>
                </div>
                <div class="material-footer">
                    <div class="material-stats">
                        <span class="material-stat">
                            <i class="fas fa-calendar-alt"></i>
                            {{ $reference->created_at->format('M d, Y') }}
                        </span>
                    </div>
                    <div class="material-actions">
                        <a href="{{ route('admin.references.show', $reference->id) }}" class="btn btn-outline btn-sm"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('admin.references.edit', $reference->id) }}" class="btn btn-outline btn-sm"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.references.destroy', $reference->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline btn-sm" onclick="return confirm('Delete this reference?')"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="empty-state">
                <i class="fas fa-folder-open"></i>
                <p>No references found.</p>
            </div>
            @endforelse
        </div>
        <div class="pagination-container">
            <div class="pagination-info">
                Showing {{ $references->firstItem() ?? 0 }} to {{ $references->lastItem() ?? 0 }} of {{ $references->total() }} results
            </div>
            <div class="pagination-nav">
                @if($references->onFirstPage())
                    <button class="pagination-nav-btn" disabled>« Previous</button>
                @else
                    <a href="{{ $references->previousPageUrl() }}" class="pagination-nav-btn">« Previous</a>
                @endif
                <ul class="pagination">
                    @for($i = 1; $i <= $references->lastPage(); $i++)
                        @if($i == $references->currentPage())
                            <li class="active"><span>{{ $i }}</span></li>
                        @else
                            <li><a href="{{ $references->url($i) }}">{{ $i }}</a></li>
                        @endif
                    @endfor
                </ul>
                @if($references->hasMorePages())
                    <a href="{{ $references->nextPageUrl() }}" class="pagination-nav-btn">Next »</a>
                @else
                    <button class="pagination-nav-btn" disabled>Next »</button>
                @endif
            </div>
        </div>
    </section>
</main>

<!-- Confirmation Modal -->
<div id="confirmationModal" class="confirm-modal">
    <div class="confirm-modal-content">
        <div class="confirm-modal-icon">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <h2 id="confirmationTitle" class="confirm-modal-title">Are you sure?</h2>
        <p id="confirmationMessage" class="confirm-modal-text">Do you really want to delete this item? This process cannot be undone.</p>
        <div class="confirm-modal-actions">
            <button id="cancelButton" class="btn confirm-btn btn-confirm-cancel">Cancel</button>
            <button id="confirmButton" class="btn confirm-btn btn-confirm-delete">Delete</button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('confirmationModal');
        const cancelButton = document.getElementById('cancelButton');
        const confirmButton = document.getElementById('confirmButton');
        let formToSubmit = null;

        function showConfirmationModal(event) {
            event.preventDefault();
            formToSubmit = event.target.closest('form');
            const message = event.target.getAttribute('onclick').match(/confirm\('([^']*)'\)/);
            if (message && message[1]) {
                document.getElementById('confirmationMessage').textContent = message[1];
            }
            modal.classList.add('active');
        }

        window.showConfirmationModal = showConfirmationModal;

        function hideModal() {
            modal.classList.remove('active');
            formToSubmit = null;
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
