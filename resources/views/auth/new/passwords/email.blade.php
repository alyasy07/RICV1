<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full space-y-8 p-8 bg-white shadow-lg rounded-lg">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Reset Password
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Enter your email address and we'll send you a password reset link
                </p>
            </div>

            @if (session('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('status') }}
                </div>
            @endif

            <form class="mt-8 space-y-6" action="{{ route('new.password.email') }}" method="POST">
                @csrf
                <div>
                    <label for="email" class="sr-only">Email address</label>
                    <input id="email" name="email" type="email" required 
                           class="appearance-none rounded relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" 
                           placeholder="Email address">
                </div>

                @error('email')
                    <div class="text-red-500 text-sm">
                        {{ $message }}
                    </div>
                @enderror

                <div>
                    <button type="submit" 
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Send Password Reset Link
                    </button>
                </div>

                <div class="text-sm text-center">
                    <a href="{{ route('new.login') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                        Back to Login
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>