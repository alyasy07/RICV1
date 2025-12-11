@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/reference-theme.css') }}?v={{ time() }}" rel="stylesheet">
<style>
/* Force button styling override */
.btn, .btn-primary, .btn-secondary, .btn-outline, .action-btn, .add-btn {
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
.btn svg, .btn-primary svg, .btn-secondary svg, .btn-outline svg {
    width: 1rem !important;
    height: 1rem !important;
    flex-shrink: 0 !important;
    display: inline-block !important;
    opacity: 1 !important;
    visibility: visible !important;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
    color: white !important;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #5a6fd8 0%, #6b4190 100%) !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}

.btn-secondary {
    background: #6b7280 !important;
    color: white !important;
}

.btn-secondary:hover {
    background: #4b5563 !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 8px 20px rgba(0,0,0,0.12) !important;
}

.btn-outline {
    background: transparent !important;
    color: #667eea !important;
    border: 2px solid #667eea !important;
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
<div class="main-content">
    <div class="content-container" style="max-width: 1300px; margin: 0 auto;">
        <x-hero-section 
            title="Manage Profile" 
            subtitle="Update your personal information and account settings" 
        />

        <!-- Success/Error Messages -->
        @if(session('success'))
        <div class="alert alert-success">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            {{ session('success') }}
        </div>
        @endif
        
        @if(session('error'))
        <div class="alert alert-error">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            {{ session('error') }}
        </div>
        @endif
        
        @if ($errors->any())
        <div class="alert alert-error">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div>
                <p class="font-medium">Please correct the errors below:</p>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        <form method="POST" action="{{ route('manageProfile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Personal Information Section -->
            <div class="content-section">
                <h2 class="section-title">Personal Information</h2>
                <div class="form-card">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="form-group">
                            <label class="form-label">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path>
                                </svg>
                                User ID
                            </label>
                            <input type="text" class="form-input bg-gray-50" value="{{ $user->userID }}" readonly>
                            <p class="form-hint">Your unique user identifier</p>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" class="form-input" value="{{ old('name', $user->username) }}" required>
                            <p class="form-hint">Your display name</p>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                            </svg>
                            Email Address <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="email" class="form-input" value="{{ old('email', $user->email) }}" required>
                    </div>
                </div>
            </div>

            <!-- Change Password Section -->
            <div class="content-section">
                <h2 class="section-title">Change Password</h2>
                <div class="form-card">
                    <div class="alert alert-info mb-6">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Leave blank if you don't want to change your password
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="form-group">
                            <label class="form-label">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                                </svg>
                                New Password
                            </label>
                            <input type="password" name="password" id="password" class="form-input" minlength="8">
                            <div class="mt-2">
                                <div id="strengthBar" class="h-1 bg-gray-200 rounded-full w-full"></div>
                            </div>
                            <p class="form-hint">Minimum 8 characters</p>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                Confirm New Password
                            </label>
                            <input type="password" name="password_confirmation" id="passwordConfirm" class="form-input" minlength="8">
                            <div id="passwordMatch" class="mt-2 text-sm hidden items-center text-green-600">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Passwords match
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="content-section">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    <a href="{{ route('dashboard') }}" class="btn-secondary">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Dashboard
                    </a>
                    
                    <div class="flex space-x-3">
                        <button type="reset" class="btn-outline">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Reset
                        </button>
                        <button type="submit" class="btn-primary">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                            Update Profile
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    // Password visibility toggle
    function togglePassword(inputId, eyeIconId) {
        const passwordInput = document.getElementById(inputId);
        const eyeIcon = document.getElementById(eyeIconId);
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
    }
    
    // Password strength indicator
    document.getElementById('password').addEventListener('input', function() {
        const password = this.value;
        const strengthBar = document.getElementById('strengthBar');
        
        // Reset
        strengthBar.style.width = '0%';
        strengthBar.className = 'h-1 bg-gray-200 rounded-full w-full';
        
        if (password.length === 0) return;
        
        // Basic strength calculation
        let strength = 0;
        if (password.length >= 8) strength += 25;
        if (/[A-Z]/.test(password)) strength += 25;
        if (/[0-9]/.test(password)) strength += 25;
        if (/[^A-Za-z0-9]/.test(password)) strength += 25;
        
        strengthBar.style.width = strength + '%';
        
        if (strength < 50) {
            strengthBar.classList.add('bg-red-500');
        } else if (strength < 75) {
            strengthBar.classList.add('bg-yellow-500');
        } else {
            strengthBar.classList.add('bg-green-500');
        }
    });
    
    // Password confirmation check
    document.getElementById('passwordConfirm').addEventListener('input', function() {
        const password = document.getElementById('password').value;
        const confirmPassword = this.value;
        const matchIndicator = document.getElementById('passwordMatch');
        
        if (confirmPassword.length === 0) {
            matchIndicator.classList.add('hidden');
            matchIndicator.classList.remove('flex');
            return;
        }
        
        if (password === confirmPassword) {
            matchIndicator.classList.remove('hidden');
            matchIndicator.classList.add('flex');
        } else {
            matchIndicator.classList.add('hidden');
            matchIndicator.classList.remove('flex');
        }
    });
</script>
@endsection