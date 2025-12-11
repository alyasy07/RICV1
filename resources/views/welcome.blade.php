<!DOCTYPE html>
<!-- 
    Migrated theme logic to Alpine.js. 
    The 'dark' class is dynamically applied to the html element based on the 'darkMode' state.
-->
<html lang="en" x-data="{
    darkMode: localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches),
    toggle() {
        this.darkMode = !this.darkMode;
        localStorage.setItem('theme', this.darkMode ? 'dark' : 'light');
    }
}" :class="{'dark': darkMode}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Research Ideation Canvas</title>
    <link rel="icon" href="/images/logo.png" type="image/x-icon">
    <!-- Load Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Load Alpine.js for interactivity -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>

    <!-- Configure Tailwind for Customizations and Font -->
    <script>
        tailwind.config = {
            darkMode: 'class', // Enable dark mode using 'dark' class (now controlled by Alpine on <html>)
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Instrument Sans', 'Inter', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        'primary-violet': '#6366F1', // Indigo 500
                        'accent-amber': '#F59E0B', // Amber 500
                        'bg-light': '#ffffffff', // Light Gray background
                        'bg-dark': '#0F172A', // Dark Slate background
                    }
                },
            }
        }
    </script>

    <!-- Instrument Sans Font Link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    
    <!-- Icons from Lucide for a modern professional look -->
    <script type="module">
        // FIX: Import the entire module as 'lucide' and destructure the required components, 
        // because the UMD build does not support named imports like '{ LayoutGrid }' directly.
        import * as lucide from 'https://unpkg.com/lucide@latest/dist/umd/lucide.js';
        const { createIcons, User, LayoutGrid } = lucide;
        
        window.onload = () => {
             // Defer icon creation until the DOM is ready
            createIcons({
                icons: {
                    User,
                    LayoutGrid
                }
            });
        };
        // Removed original dark mode JS logic, which is now handled by Alpine.js in the <html> tag.
    </script>
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
            z-index: 0;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
        
        .shape-1 {
            width: 120px;
            height: 120px;
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
            width: 100px;
            height: 100px;
            background: linear-gradient(45deg, #43e97b, #38f9d7);
            bottom: 15%;
            left: 15%;
            animation-delay: 4s;
        }
        
        .shape-4 {
            width: 90px;
            height: 90px;
            background: linear-gradient(45deg, #fa709a, #fee140);
            top: 30%;
            right: 5%;
            animation-delay: 1s;
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
        
        /* Custom styles for the fun, vibrant feel */
        .stat-card {
            transition: all 0.3s ease-in-out;
            cursor: pointer;
            border: 1px solid transparent;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
        .stat-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 12px 30px rgba(99, 102, 241, 0.3);
        }
        .dark .stat-card {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        .dark .stat-card:hover {
            box-shadow: 0 12px 30px rgba(99, 102, 241, 0.4);
            border-color: rgba(255, 255, 255, 0.1);
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
        
        /* Logo bounce animation */
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        
        .logo-animate:hover {
            animation: bounce 0.6s ease;
        }
    </style>
</head>

<body class="bg-bg-light dark:bg-bg-dark text-gray-900 dark:text-gray-100 font-sans flex p-4 lg:p-8 items-center justify-center min-h-screen">
    
    <!-- Floating decorative shapes -->
    <div class="floating-shape shape-1"></div>
    <div class="floating-shape shape-2"></div>
    <div class="floating-shape shape-3"></div>
    <div class="floating-shape shape-4"></div>

    <!-- Main Content Container (Shadow and Rounded Corners for Professionalism) -->
    <div class="w-full max-w-lg lg:max-w-4xl main-card-bg dark:border-gray-700 dark:shadow-2xl rounded-3xl shadow-2xl overflow-hidden p-1">
        
        <!-- Inner glass card -->
        <div class="glass-card rounded-3xl">
        
        <!-- Header with Auth Links and Theme Toggle -->
        <header class="p-6 lg:p-8 flex items-center justify-between border-b border-gray-200 dark:border-gray-700">
    <!-- LEFT SIDE: logos -->
    <div class="flex items-center gap-4">
        <img src="/images/UMK.png" alt="UMK Logo" class="h-20 w-auto logo-animate">
    </div>

    <!-- RIGHT SIDE: navigation and theme toggle -->
    <nav class="flex items-center gap-4 text-sm font-medium">
        <a href="/login" class="px-4 py-2 text-primary-violet dark:text-primary-violet rounded-xl hover:bg-primary-violet/10 dark:hover:bg-primary-violet/20 transition-all duration-300 font-semibold">
            Log in
        </a>
        <a href="/register" class="btn-primary px-5 py-2 bg-gradient-to-r from-primary-violet to-purple-600 text-white rounded-xl hover:from-indigo-600 hover:to-purple-700 transition-all duration-300 shadow-lg font-semibold">
            Register
        </a>

        <!-- Theme toggle -->
        <button @click="toggle()" id="theme-toggle" class="p-2.5 ml-2 rounded-full text-primary-violet dark:text-accent-amber bg-white/50 dark:bg-gray-800/50 hover:bg-white dark:hover:bg-gray-700 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-110" aria-label="Toggle theme">
            <svg class="w-5 h-5 dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
            <svg class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
            </svg>
        </button>
    </nav>
</header>

        <!-- Main Content Section -->
        <main class="p-8 lg:p-16 text-center relative z-10">
            
            <span class="text-sm font-semibold uppercase tracking-widest text-primary-violet dark:text-indigo-300 mb-2 block">
                Entrepreneurship Research Hub
            </span>

            <h1 class="text-5xl lg:text-6xl font-extrabold mb-4 bg-gradient-to-r from-primary-violet via-purple-600 to-pink-600 bg-clip-text text-transparent leading-tight">
                Research Ideation Canvas
            </h1>
            
            <p class="text-lg mb-10 text-gray-600 dark:text-gray-400 max-w-md mx-auto">
                Where great ideas get visualized. Start brainstorming, collaborating, and bringing your concepts to life.
            </p>

            <!-- Statistics Cards (The 'Fun' part with icons and accent color) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-12">
                
                <!-- Stat Card 1: Total Registered Users -->
                <div class="stat-card bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm p-6 rounded-2xl text-left border-2 border-primary-violet/20 dark:border-primary-violet/30">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 flex items-center justify-center rounded-full bg-gradient-to-br from-accent-amber to-orange-500 text-white shrink-0 shadow-lg">
                            <!-- Lucide User Icon -->
                            <i data-lucide="user" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $totalUsers }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Total Registered Users</p>
                        </div>
                    </div>
                </div>

                <!-- Stat Card 2: Total Canvases Created -->
                <div class="stat-card bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm p-6 rounded-2xl text-left border-2 border-primary-violet/20 dark:border-primary-violet/30">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 flex items-center justify-center rounded-full bg-gradient-to-br from-primary-violet to-purple-600 text-white shrink-0 shadow-lg">
                            <!-- Lucide LayoutGrid Icon -->
                            <i data-lucide="layout-grid" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $totalCanvases }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Canvases Created</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-10">
                <a href="/register" class="btn-primary inline-flex items-center justify-center px-8 py-4 border border-transparent text-base font-bold rounded-xl text-white bg-gradient-to-r from-primary-violet to-purple-600 hover:from-indigo-600 hover:to-purple-700 shadow-xl shadow-primary-violet/30 dark:shadow-primary-violet/50 transition-all duration-300">
                    <span class="relative z-10">Get Started - It's Free!</span>
                </a>
            </div>

        </main>
        
        <!-- Footer / Branding -->
        <footer class="p-6 lg:p-8 text-xs text-center text-gray-400 border-t border-gray-200 dark:border-gray-700 mt-10">
            &copy; 2025 Global Entrepreneurship Research and Innovation Centre. All rights reserved.
        </footer>
        
        </div>
    </div>
</body>
</html>