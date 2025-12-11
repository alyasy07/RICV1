<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Research Ideation Canvas | Brainstorm Space</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap');
        
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f9f7f7;
        }
        
        .note {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .note:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.15);
        }
        
        .sticky-note {
            position: relative;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            background-color: white;
            border: 1px solid rgba(0,0,0,0.1);
        }
        
        .sticky-note:before {
            display: none;
        }
        
        .form-section {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            margin-bottom: 24px;
        }
        
        .form-title {
            color: #1F2937;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 1.25rem;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #E5E7EB;
        }
        
        .idea-pin {
            position: absolute;
            top: -8px;
            right: 15px;
            width: 20px;
            height: 20px;
            background-color: #f87171;
            border-radius: 50%;
            z-index: 10;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }
        
        .flow-card {
            border-left: 4px solid;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .flow-card:hover {
            transform: scale(1.02);
        }
        
        .color-1 { background-color: #fef3c7; border-color: #f59e0b; }
        .color-2 { background-color: #dbeafe; border-color: #3b82f6; }
        .color-3 { background-color: #e0e7ff; border-color: #6366f1; }
        .color-4 { background-color: #fce7f3; border-color: #ec4899; }
        .color-5 { background-color: #dcfce7; border-color: #22c55e; }
        
        .handwritten {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            letter-spacing: 0.3px;
            text-transform: uppercase;
            font-size: 0.875rem;
        }
        
        .title-text {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        
        .description-text {
            font-family: 'Nunito', sans-serif;
            font-weight: 500;
            line-height: 1.6;
        }
        
        .field-label {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 0.875rem;
            text-transform: uppercase;
            color: #374151;
            letter-spacing: 0.05em;
        }
        
        .field-hint {
            font-family: 'Nunito', sans-serif;
            font-weight: 400;
            font-size: 0.75rem;
            color: #6B7280;
            margin-top: 0.25rem;
        }
        
        .title-decor {
            background: linear-gradient(120deg, #a78bfa, #f472b6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .btn-creative {
            background: linear-gradient(135deg, #a78bfa, #f472b6);
            border: none;
            border-radius: 50px;
            padding: 10px 20px;
            color: white;
            font-weight: bold;
            box-shadow: 0 4px 10px rgba(167, 139, 250, 0.3);
            transition: all 0.3s ease;
        }
        
        .btn-creative:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(167, 139, 250, 0.4);
        }
        
        .section-header {
            position: relative;
            display: inline-block;
            margin-bottom: 20px;
            font-family: 'Nunito', sans-serif;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        
        .section-header:after {
            content: "";
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, #a78bfa, #f472b6);
            border-radius: 3px;
            opacity: 0.8;
            transition: opacity 0.3s ease;
        }
        
        .section-header:hover:after {
            opacity: 1;
        }
        
        .bubble {
            background-color: white;
            border-radius: 20px;
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
            margin-bottom: 15px;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-gradient-to-br from-blue-50 to-purple-50 min-h-screen">
    @yield('content')
    @stack('scripts')
</body>
</html>