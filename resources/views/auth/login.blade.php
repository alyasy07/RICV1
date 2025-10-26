<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log Masuk - {{ config('app.name') }}</title>
    <link rel="icon" type="image/png" sizes="180x180" href="{{ asset('images/logo_rms.png') }}">
    <link href="{{ asset('css/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            height: 100vh;
            overflow: hidden;
            position: relative;
        }

        .page-wrapper {
            display: flex;
            height: 100vh;
            width: 100%;
            position: relative;
        }

        /* Left side - Image section with slide animation */
        .image-section {
            width: 50%;
            height: 100%;
            background: url('{{ asset('images/welcome_bg.jpg') }}') no-repeat center center;
            background-size: cover;
            position: relative;
            transition: transform 0.8s cubic-bezier(0.645, 0.045, 0.355, 1);
            animation: slideInFromLeft 0.8s cubic-bezier(0.645, 0.045, 0.355, 1);
        }

        @keyframes slideInFromLeft {
            from {
                transform: translateX(-100%);
            }
            to {
                transform: translateX(0);
            }
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.1));
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 3rem;
        }
        
        .back-button {
            position: absolute;
            top: 2rem;
            left: 2rem;
            background-color: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(5px);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            z-index: 10;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-decoration: none;
        }
        
        .back-button:hover {
            background-color: rgba(255, 255, 255, 0.3);
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
        
        .back-button:hover::after {
            content: "Kembali";
            position: absolute;
            bottom: -30px;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.8rem;
            white-space: nowrap;
        }
        
        .back-button i {
            font-size: 1.5rem;
        }

        .logo-container {
            position: absolute;
            top: 2rem;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
        }

        .logo-umk {
            height: 80px;
            width: auto;
        }

        .system-title {
            color: white;
            text-align: center;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
        }

        .system-title h1 {
            font-size: 5rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .system-title .subtitle {
            font-size: 1.2rem;
            font-weight: 500;
            opacity: 0.95;
        }

        .geric-logo {
            position: absolute;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            height: 60px;
            width: auto;
        }

        /* Right side - Login form with orange gradient */
        .login-section {
            width: 50%;
            height: 100%;
            background: linear-gradient(135deg, #FF9A56 0%, #FF6B35 50%, #9B4DCA 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            animation: slideInFromRight 0.8s cubic-bezier(0.645, 0.045, 0.355, 1);
        }

        @keyframes slideInFromRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .login-card {
            background: white;
            border-radius: 24px;
            padding: 3rem 2.5rem;
            width: 100%;
            max-width: 480px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-header h2 {
            color: #4A3F8F;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .login-header p {
            color: #666;
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            color: #333;
            font-weight: 500;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        .form-control {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 1px solid #E0E0E0;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s;
            background: #F8F9FA;
        }

        .form-control:focus {
            outline: none;
            border-color: #9B4DCA;
            background: white;
            box-shadow: 0 0 0 3px rgba(155, 77, 202, 0.1);
        }

        .form-control.is-invalid {
            border-color: #dc3545;
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: block;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-check input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .form-check label {
            color: #333;
            font-size: 0.9rem;
            margin: 0;
            cursor: pointer;
        }

        .forgot-link {
            color: #FF6B35;
            font-size: 0.9rem;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .forgot-link:hover {
            color: #9B4DCA;
        }

        .btn-login {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #9B4DCA 0%, #7B3AA8 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 12px rgba(155, 77, 202, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(155, 77, 202, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .alert {
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }

        .alert-danger {
            background-color: #fee;
            color: #c33;
            border: 1px solid #fcc;
        }

        .alert ul {
            margin: 0;
            padding-left: 1.25rem;
        }

        /* Responsive */
        @media (max-width: 968px) {
            .page-wrapper {
                flex-direction: column;
            }

            .image-section {
                width: 100%;
                height: 30%;
            }

            .login-section {
                width: 100%;
                height: 70%;
            }

            .system-title h1 {
                font-size: 2rem;
            }

            .logo-container {
                top: 1rem;
            }

            .logo-umk {
                height: 50px;
            }

            .geric-logo {
                height: 45px;
                bottom: 1rem;
            }
        }

        /* Page load fade-in animation */
        body {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class="page-wrapper">
        <!-- Left Side - Image with Building -->
        <div class="image-section">
            <div class="image-overlay">
                <a href="{{ route('welcome') }}" class="back-button" title="Kembali ke Halaman Utama">
                    <i class="fas fa-arrow-left"></i>
                </a>
                
                <div class="logo-container">
                    <img src="{{ asset('images/umk-logo.png') }}" alt="UMK Logo" class="logo-umk">
                </div>
                
                <div class="system-title">
                    <h1>SISTEM<br>PENGURUSAN<br>LAPORAN</h1>
                    <p class="subtitle">KETERANGAN WEBSITE</p>
                </div>

                <img src="{{ asset('images/logo-geric.png') }}" alt="GERIC Logo" class="geric-logo">
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="login-section">
            <div class="login-card">
                <div class="login-header">
                    <h2>Selamat Datang</h2>
                    <p>Log masuk ke akaun anda</p>
                </div>

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login.post') }}">
                    @csrf
                    
                    <div class="form-group">
                        <label for="email">E-mel</label>
                        <input 
                            type="email" 
                            class="form-control @error('email') is-invalid @enderror" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            placeholder="Masukkan e-mel anda" 
                            required
                            autofocus
                        >
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Kata Laluan</label>
                        <div style="position: relative;">
                            <input 
                                type="password" 
                                class="form-control @error('password') is-invalid @enderror" 
                                id="password" 
                                name="password" 
                                placeholder="Masukkan kata laluan anda" 
                                required
                            >
                            <span style="position: absolute; top: 50%; right: 15px; transform: translateY(-50%); cursor: pointer; width: 20px; height: 20px; display: flex; align-items: center; justify-content: center;" id="toggleLoginPassword">
                                <i class="fas fa-eye fa-sm" style="color: #6c757d; font-size: 0.9rem;"></i>
                            </span>
                        </div>
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="remember-forgot">
                        <div class="form-check">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">Ingat saya</label>
                        </div>
                        <a href="{{ route('password.request') }}" class="forgot-link">Lupa kata laluan?</a>
                    </div>
                    
                    <button type="submit" class="btn-login">Log Masuk</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Remove alerts after 5 seconds
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
        
        // Toggle password visibility
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.getElementById('toggleLoginPassword');
            const password = document.getElementById('password');
            
            togglePassword.addEventListener('click', function() {
                // Toggle type attribute
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                
                // Toggle icon
                const icon = this.querySelector('i');
                if (icon.classList.contains('fa-eye')) {
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });
    </script>
</body>
</html>