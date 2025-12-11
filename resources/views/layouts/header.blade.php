@php
    use Illuminate\Support\Facades\Auth;
@endphp

<style>
    .logout-btn {
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .logout-btn:hover {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%) !important;
        color: white !important;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    .logout-btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .logout-btn:active::before {
        width: 300px;
        height: 300px;
    }

    .profile-btn {
        transition: all 0.3s ease;
    }

    .profile-btn:hover {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        color: white !important;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    /* Logout Confirmation Modal */
    .logout-modal-overlay {
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

    .logout-modal-overlay.active {
        display: flex;
    }

    .logout-modal {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        max-width: 400px;
        width: 90%;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        animation: slideUp 0.3s ease;
        position: relative;
    }

    .logout-modal-icon {
        width: 60px;
        height: 60px;
        margin: 0 auto 1.5rem;
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #dc2626;
        font-size: 1.8rem;
    }

    .logout-modal-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1f2937;
        text-align: center;
        margin-bottom: 0.75rem;
    }

    .logout-modal-message {
        color: #6b7280;
        text-align: center;
        margin-bottom: 2rem;
        line-height: 1.6;
    }

    .logout-modal-actions {
        display: flex;
        gap: 1rem;
        justify-content: center;
    }

    .logout-modal-btn {
        padding: 0.75rem 2rem;
        border-radius: 10px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 0.95rem;
    }

    .logout-modal-btn-cancel {
        background: #e5e7eb;
        color: #374151;
    }

    .logout-modal-btn-cancel:hover {
        background: #d1d5db;
        transform: translateY(-1px);
    }

    .logout-modal-btn-confirm {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    .logout-modal-btn-confirm:hover {
        background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(239, 68, 68, 0.4);
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
</style>

<header class="bg-white shadow-sm">
    <div class="max-w-6xl mx-auto px-3 sm:px-4 lg:px-6">
        <div class="flex justify-between items-center h-16">
            
            <div class="flex items-center space-x-8">
                <div class="flex-shrink-0">
                    <a href="{{ route('dashboard') }}" class="text-2xl font-bold">
                        <span class="text-blue-800">Reasearch </span><span class="text-blue-500">Ideation</span>
                    </a>
                </div>
                
                <div class="hidden md:block">
                    <div class="flex items-baseline space-x-4">
                        @if(Auth::check() && Auth::user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" 
                               class="{{ request()->routeIs('admin.dashboard') ? 'header-active' : 'text-gray-600 hover:text-blue-700' }} px-3 py-2 rounded-md text-sm font-medium">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('dashboard') }}" 
                               class="{{ request()->routeIs('dashboard') || request()->routeIs('home') ? 'header-active' : 'text-gray-600 hover:text-blue-700' }} px-3 py-2 rounded-md text-sm font-medium">
                                Dashboard
                            </a>
                        @endif
                        <a href="{{ route('canvas.index') }}" 
                           class="{{ request()->routeIs('canvas.*') ? 'header-active' : 'text-gray-600 hover:text-blue-700' }} px-3 py-2 rounded-md text-sm font-medium">
                            My Canvas
                        </a>
                        @if(Auth::check() && Auth::user()->isAdmin())
                            <a href="{{ route('admin.references.index') }}" 
                               class="{{ request()->routeIs('admin.references.*') ? 'header-active' : 'text-gray-600 hover:text-blue-700' }} px-3 py-2 rounded-md text-sm font-medium">
                                References
                            </a>
                        @else
                            <a href="{{ route('references.index') }}" 
                               class="{{ request()->routeIs('references.*') && !request()->routeIs('admin.*') ? 'header-active' : 'text-gray-600 hover:text-blue-700' }} px-3 py-2 rounded-md text-sm font-medium">
                                References
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6 space-x-4">
                    <a href="{{ route('manageProfile') }}" 
                       class="profile-btn text-gray-700 hover:bg-gray-200 hover:text-black px-3 py-2 rounded-md text-sm font-medium">
                        Profile
                    </a>
                    
                    <button type="button" onclick="showLogoutModal()" 
                            class="logout-btn text-gray-700 hover:bg-gray-200 hover:text-black px-3 py-2 rounded-md text-sm font-medium">
                        Logout
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Logout Confirmation Modal -->
<div id="logoutModal" class="logout-modal-overlay">
    <div class="logout-modal">
        <div class="logout-modal-icon">
            <i class="fas fa-sign-out-alt"></i>
        </div>
        <h3 class="logout-modal-title">Confirm Logout</h3>
        <p class="logout-modal-message">Are you sure you want to logout? You will need to login again to access your account.</p>
        <div class="logout-modal-actions">
            <button type="button" onclick="hideLogoutModal()" class="logout-modal-btn logout-modal-btn-cancel">
                Cancel
            </button>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="logout-modal-btn logout-modal-btn-confirm">
                    Yes, Logout
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function showLogoutModal() {
    document.getElementById('logoutModal').classList.add('active');
    document.body.style.overflow = 'hidden';
}

function hideLogoutModal() {
    document.getElementById('logoutModal').classList.remove('active');
    document.body.style.overflow = 'auto';
}

// Close modal when clicking outside
document.getElementById('logoutModal').addEventListener('click', function(e) {
    if (e.target === this) {
        hideLogoutModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        hideLogoutModal();
    }
});
</script>
