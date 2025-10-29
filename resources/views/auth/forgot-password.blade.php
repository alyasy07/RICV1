<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Set Semula Kata Laluan – {{ config('app.name') }}</title>
    <link rel="icon" type="image/png" sizes="180x180" href="{{ asset('images/bulat_logo2.png') }}">
    <link href="{{ asset('css/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        // Redirect to the correct forgot password route
        window.location.href = "{{ route('password.request') }}";
    </script>
    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #FF9A56 0%, #FF6B35 50%, #9B4DCA 100%);
            margin: 0;
            padding: 20px;
        }
        
        .loading-container {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        
        .loading-text {
            margin-top: 15px;
            color: #4A3F8F;
            font-weight: 500;
        }
        
        .spinner {
            display: inline-block;
            width: 40px;
            height: 40px;
            border: 4px solid rgba(74, 63, 143, 0.1);
            border-radius: 50%;
            border-top-color: #4A3F8F;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="loading-container">
        <div class="spinner"></div>
        <p class="loading-text">Mengarahkan semula ke halaman set semula kata laluan...</p>
    </div>
</body>
</html>
