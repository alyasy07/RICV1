@php
use Illuminate\Support\Facades\Route;
@endphp
<!DOCTYPE html>
<html lang="en" x-data="{
    darkMode: localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches),
    toggle() {
        this.darkMode = !this.darkMode;
        localStorage.setItem('theme', this.darkMode ? 'dark' : 'light');
    }
}" :class="{'dark': darkMode}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Research Ideation Canvas</title>
    <link rel="icon" href="/images/logo.png" type="image/x-icon">

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js" defer></script>
    
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Instrument Sans', 'Inter', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        'primary-violet': '#6366F1', // Indigo 500
                        'accent-amber': '#F59E0B', // Amber 500
                        'bg-light': '#ffffffff', 
                        'bg-dark': '#0F172A', 
                        'black': '#000000',
                    }
                },
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    
    <style>
        body{
            background-size: cover;
            background-attachment: fixed;
            background-image: url('/images/bg.png');
            position: relative;
            overflow-x: hidden;
        }
        
        /* Animated gradient background for the card */
        .main-card-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            background-size: 200% 200%;
            animation: gradientShift 8s ease infinite;
            position: relative;
        }
        
        .dark .main-card-bg {
            background: linear-gradient(135deg, #1f2937 0%, #3b1f6e 50%, #111827 100%);
            background-size: 200% 200%;
            animation: gradientShift 8s ease infinite;
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        /* Fun floating shapes */
        .floating-shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
        
        .shape-1 {
            width: 100px;
            height: 100px;
            background: linear-gradient(45deg, #f093fb, #f5576c);
            top: 10%;
            left: 5%;
            animation-delay: 0s;
        }
        
        .shape-2 {
            width: 150px;
            height: 150px;
            background: linear-gradient(45deg, #4facfe, #00f2fe);
            top: 60%;
            right: 10%;
            animation-delay: 2s;
        }
        
        .shape-3 {
            width: 80px;
            height: 80px;
            background: linear-gradient(45deg, #43e97b, #38f9d7);
            bottom: 15%;
            left: 15%;
            animation-delay: 4s;
        }
        
        /* Glassmorphism effect */
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .dark .glass-card {
            background: rgba(31, 41, 55, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        /* Button hover effects */
        .btn-primary {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .btn-primary::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }
        
        .btn-primary:hover::before {
            width: 300px;
            height: 300px;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.4);
        }
        
        /* Input focus effects */
        .input-fancy:focus {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.2);
        }
        
        /* Logo bounce animation */
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        
        .logo-animate:hover {
            animation: bounce 0.6s ease;
        }

        /* Success message animation */
        @keyframes bounce-in {
            0% {
                opacity: 0;
                transform: scale(0.9) translateY(-10px);
            }
            60% {
                opacity: 1;
                transform: scale(1.02) translateY(0);
            }
            100% {
                transform: scale(1) translateY(0);
            }
        }
        
        .animate-bounce-in {
            animation: bounce-in 0.5s ease-out;
        }
    </style>
</head>

<body class="bg-bg-light dark:bg-bg-dark text-gray-900 dark:text-gray-100 font-sans flex items-center justify-center min-h-screen p-4 sm:p-0">

    <!-- Floating decorative shapes -->
    <div class="floating-shape shape-1"></div>
    <div class="floating-shape shape-2"></div>
    <div class="floating-shape shape-3"></div>

    <div class="w-full max-w-md main-card-bg dark:border-gray-700 dark:shadow-2xl rounded-3xl shadow-2xl overflow-hidden p-1">
        
        <!-- Inner glass card -->
        <div class="glass-card rounded-3xl p-6 sm:p-8 lg:p-10">
        
        <!-- Back Button and Theme Toggle -->
        <div class="flex justify-between items-center mb-4">
            <!-- Back Button -->
            <a href="{{ route('welcome') }}" class="inline-flex items-center p-2.5 rounded-full text-primary-violet dark:text-accent-amber bg-white/50 dark:bg-gray-800/50 hover:bg-white dark:hover:bg-gray-700 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-110" aria-label="Back to welcome page">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            
            <!-- Theme Toggle Button -->
            <button @click="toggle()" id="theme-toggle" class="p-2.5 rounded-full text-primary-violet dark:text-accent-amber bg-white/50 dark:bg-gray-800/50 hover:bg-white dark:hover:bg-gray-700 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-110" aria-label="Toggle theme">
                <svg class="w-5 h-5 dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                <svg class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                </svg>
            </button>
        </div>

        <div class="flex flex-col items-center justify-center mb-8">
            <a href="/" class="logo-animate inline-block">
                <img src="/images/UMK.png" alt="UMK Logo" class="h-16 w-auto mb-4 drop-shadow-lg">
            </a>
            <h2 class="text-4xl font-extrabold bg-gradient-to-r from-primary-violet to-pink-600 bg-clip-text text-transparent mb-2">
                Welcome Back
            </h2>
            <p class="text-sm text-gray-600 dark:text-gray-400">Sign in to continue your research journey</p>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border-2 border-green-200 dark:border-green-700 shadow-lg animate-bounce-in">
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-green-800 dark:text-green-300 font-semibold">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-gray-700 dark:text-gray-300 font-semibold"/>
                <x-text-input id="email" class="input-fancy block mt-2 w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 dark:bg-gray-700/50 dark:text-white focus:border-primary-violet focus:ring-primary-violet dark:focus:border-primary-violet dark:focus:ring-primary-violet rounded-xl shadow-sm transition-all duration-300" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="your.email@example.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" class="text-gray-700 dark:text-gray-300 font-semibold"/>

                <x-text-input id="password" class="input-fancy block mt-2 w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 dark:bg-gray-700/50 dark:text-white focus:border-primary-violet focus:ring-primary-violet dark:focus:border-primary-violet dark:focus:ring-primary-violet rounded-xl shadow-sm transition-all duration-300"
                                type="password"
                                name="password"
                                required autocomplete="current-password"
                                placeholder="Enter your password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 dark:border-gray-600 text-primary-violet shadow-sm focus:ring-primary-violet dark:focus:ring-primary-violet dark:focus:ring-offset-gray-800 transition-all duration-300" name="remember">
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400 group-hover:text-primary-violet transition-colors">{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-primary-violet dark:text-indigo-400 hover:text-indigo-600 dark:hover:text-indigo-300 font-medium transition-colors" href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <button type="submit" class="btn-primary w-full inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-primary-violet to-purple-600 border border-transparent rounded-xl font-bold text-base text-white uppercase tracking-wide hover:from-indigo-600 hover:to-purple-700 focus:outline-none focus:ring-4 focus:ring-primary-violet/50 transition-all duration-300 shadow-lg">
                    <span class="relative z-10">{{ __('Sign In') }}</span>
                </button>
            </div>

            <!-- Divider -->
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300 dark:border-gray-600"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-4 bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400 rounded-full">
                        New here?
                    </span>
                </div>
            </div>

            <!-- Register Link -->
            <div class="text-center">
                <a class="inline-flex items-center justify-center w-full px-6 py-3 bg-white dark:bg-gray-700 border-2 border-primary-violet dark:border-indigo-400 rounded-xl font-bold text-sm text-primary-violet dark:text-indigo-400 uppercase tracking-wide hover:bg-primary-violet hover:text-white dark:hover:bg-indigo-600 dark:hover:text-white transition-all duration-300 shadow-md hover:shadow-xl" href="{{ route('register') }}">
                    {{ __('Create Account') }}
                </a>
            </div>
        </form>
        
        </div>
    </div>
</body>
</html>
