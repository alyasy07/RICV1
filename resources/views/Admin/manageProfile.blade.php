@php
// Admin-only system
$routePrefix = function($route) {
    return 'admin.' . $route;
};
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="180x180" href="{{ asset('images/bulat_logo2.png') }}">
    <title>Urus Profil – {{ config('app.name') }}</title>
    <link href="{{ asset('css/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        .table th {
            background-color: #2E5AAC !important;
            color: white !important;
        }
    </style>
</head>
<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Include Sidebar -->
    @include('layouts.sidebar')

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            @include('layouts.header')
            <!-- End of Topbar -->
            
            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800">Urus Profil</h1>
                
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow-sm" style="background:white; border-radius:8px;">
                            <div class="card-body">
                                
                                <!-- Display validation errors -->
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <!-- Display success/error messages -->
                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                @if(session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                <form method="POST" action="{{ route($routePrefix('updateProfile')) }}">
                                    @csrf
                                    @method('PUT')
                                    
                                    <!-- Personal Information -->
                                    <div class="card mb-4">
                                        <div class="card-header text-white" style="background-color: #2E5AAC;">
                                            <h5 class="mb-0">Maklumat Peribadi</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>ID Pengguna</label>
                                                        <input type="text" class="form-control" value="{{ $user->userID }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nama Pengguna <span class="text-danger">*</span></label>
                                                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" 
                                                               value="{{ old('username', $user->username) }}" required>
                                                        @error('username')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nombor IC <span class="text-danger">*</span></label>
                                                        <input type="text" name="icNumber" class="form-control @error('icNumber') is-invalid @enderror" 
                                                               value="{{ old('icNumber', $user->icNumber) }}" 
                                                               pattern="[0-9]{6}-[0-9]{2}-[0-9]{4}" 
                                                               placeholder="021108-06-0076"
                                                               title="Format: XXXXXX-XX-XXXX (contoh: 021108-06-0076)"
                                                               maxlength="14" required>
                                                        <small class="form-text text-muted">Format: XXXXXX-XX-XXXX</small>
                                                        @error('icNumber')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Emel <span class="text-danger">*</span></label>
                                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                                               value="{{ old('email', $user->email) }}" 
                                                               pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                                               placeholder="contoh@example.com"
                                                               title="Sila masukkan alamat emel yang sah"
                                                               required>
                                                        <small class="form-text text-muted">Contoh: nama@domain.com</small>
                                                        @error('email')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Peranan</label>
                                                        <input type="text" class="form-control" value="{{ $user->role }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Status</label>
                                                        <input type="text" class="form-control" value="{{ $user->userStatus }}" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Password Section -->
                                    <div class="card mb-4">
                                        <div class="card-header text-white" style="background-color: #2E5AAC;">
                                            <h5 class="mb-0">Tukar Kata Laluan</h5>
                                        </div>
                                        <div class="card-body">
                                            <p class="text-muted mb-3">Biarkan kosong jika tidak mahu mengubah kata laluan</p>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Kata Laluan Baru</label>
                                                        <div class="input-group">
                                                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" 
                                                                  minlength="8">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                                                    <i class="fas fa-eye" id="toggleIcon"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        @error('password')
                                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Sahkan Kata Laluan Baru</label>
                                                        <div class="input-group">
                                                            <input type="password" name="password_confirmation" id="passwordConfirm" class="form-control" minlength="8">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text" id="togglePasswordConfirm" style="cursor: pointer;">
                                                                    <i class="fas fa-eye" id="toggleIconConfirm"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save mr-2"></i>Kemaskini Profil
                                        </button>
                                        <a href="{{ route($routePrefix('dashboard')) }}" class="btn btn-secondary">
                                            <i class="fas fa-arrow-left mr-2"></i>Kembali
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Hak Cipta &copy; {{ config('app.name') }} {{ date('Y') }}</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->

<script src="{{ asset('js/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('js/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

<script>
// IC Number formatting and validation
$(document).ready(function() {
    // Format IC number as user types
    $('input[name="icNumber"]').on('input', function() {
        let value = $(this).val().replace(/\D/g, ''); // Remove non-digits
        
        // Auto-format with dashes
        if (value.length >= 6) {
            value = value.substring(0, 6) + '-' + value.substring(6);
        }
        if (value.length >= 9) {
            value = value.substring(0, 9) + '-' + value.substring(9);
        }
        
        // Limit to 14 characters (including dashes)
        if (value.length > 14) {
            value = value.substring(0, 14);
        }
        
        $(this).val(value);
        
        // Real-time validation
        validateICNumber(value, $(this));
    });
    
    // Prevent non-numeric input for IC (except dashes)
    $('input[name="icNumber"]').on('keypress', function(e) {
        const char = String.fromCharCode(e.which);
        if (!/[0-9\-]/.test(char) && e.which !== 8) {
            e.preventDefault();
        }
    });
    
    // Email validation
    $('input[name="email"]').on('blur', function() {
        validateEmail($(this).val(), $(this));
    });
});

function validateICNumber(icNumber, inputElement) {
    const icPattern = /^[0-9]{6}-[0-9]{2}-[0-9]{4}$/;
    const isValid = icPattern.test(icNumber);
    
    if (icNumber.length > 0 && !isValid) {
        inputElement.addClass('is-invalid').removeClass('is-valid');
        // Add custom error message if doesn't exist
        if (!inputElement.siblings('.invalid-feedback.ic-error').length) {
            inputElement.after('<div class="invalid-feedback ic-error">Format IC tidak sah. Gunakan format: XXXXXX-XX-XXXX</div>');
        }
    } else if (isValid) {
        inputElement.addClass('is-valid').removeClass('is-invalid');
        inputElement.siblings('.invalid-feedback.ic-error').remove();
    } else {
        inputElement.removeClass('is-invalid is-valid');
        inputElement.siblings('.invalid-feedback.ic-error').remove();
    }
}

function validateEmail(email, inputElement) {
    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    const isValid = emailPattern.test(email);
    
    if (email.length > 0 && !isValid) {
        inputElement.addClass('is-invalid').removeClass('is-valid');
        // Add custom error message if doesn't exist
        if (!inputElement.siblings('.invalid-feedback.email-error').length) {
            inputElement.after('<div class="invalid-feedback email-error">Format emel tidak sah. Contoh: nama@domain.com</div>');
        }
    } else if (isValid) {
        inputElement.addClass('is-valid').removeClass('is-invalid');
        inputElement.siblings('.invalid-feedback.email-error').remove();
    } else {
        inputElement.removeClass('is-invalid is-valid');
        inputElement.siblings('.invalid-feedback.email-error').remove();
    }
}

// Auto-dismiss alerts after 8 seconds
setTimeout(function() {
    $('.alert').fadeOut('slow', function() {
        $(this).remove();
    });
}, 8000);

// Toggle password visibility
$(document).ready(function() {
    // For new password field
    $('#togglePassword').on('click', function() {
        const passwordField = $('#password');
        const passwordFieldType = passwordField.attr('type');
        const toggleIcon = $('#toggleIcon');
        
        // Toggle password visibility
        if (passwordFieldType === 'password') {
            passwordField.attr('type', 'text');
            toggleIcon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            passwordField.attr('type', 'password');
            toggleIcon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });
    
    // For password confirmation field
    $('#togglePasswordConfirm').on('click', function() {
        const confirmField = $('#passwordConfirm');
        const confirmFieldType = confirmField.attr('type');
        const toggleIcon = $('#toggleIconConfirm');
        
        // Toggle password visibility
        if (confirmFieldType === 'password') {
            confirmField.attr('type', 'text');
            toggleIcon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            confirmField.attr('type', 'password');
            toggleIcon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });
});
</script>
</body>
</html>
