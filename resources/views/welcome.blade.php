<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="180x180" href="{{ asset('images/bulat_logo2.png') }}">
    <title>{{ config('app.name') }} - Sistem Pengurusan Laporan</title>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            overflow: hidden;
        }

        .header {
            background: white;
            padding: 10px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            position: relative;
            z-index: 10;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo {
            height: 50px;
            width: auto;
        }

        .header-right {
            text-align: right;
        }

        .header-right h3 {
            font-size: 14px;
            font-weight: bold;
            color: #333;
            margin: 0;
        }

        .header-right p {
            font-size: 11px;
            color: #666;
            margin: 2px 0 0 0;
        }

        .main-container {
            position: relative;
            height: calc(100vh - 140px);
            background: url('{{ asset('images/welcome_bg.jpg') }}') center/cover no-repeat;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .main-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }

        .content {
            position: relative;
            z-index: 5;
            text-align: center;
            color: white;
        }

        .main-title {
            font-size: 6rem;
            font-weight: bold;
            color: #000000ff;
            -webkit-text-stroke: 3px #fdececff;
            margin-bottom: 20px;
            letter-spacing: 2px;
        }

        .subtitle {
            font-size: 1.8rem;
            font-weight: 500;
            text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.7);
            margin-bottom: 40px;
            letter-spacing: 4px;
        }

        .login-btn {
            background: linear-gradient(135deg, #FF8C00 0%, #FFA500 100%);
            color: white;
            padding: 18px 60px;
            font-size: 1.5rem;
            font-weight: bold;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 8px 20px rgba(255, 140, 0, 0.4);
            transition: all 0.3s ease;
        }

        .login-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(255, 140, 0, 0.6);
            background: linear-gradient(135deg, #FFA500 0%, #FFB733 100%);
        }

        /* Page transition animations */
        body {
            transition: opacity 0.5s ease-in-out;
        }

        body.fade-out {
            opacity: 0;
        }

        .page-transition {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #FF9A56 0%, #FF6B35 50%, #9B4DCA 100%);
            z-index: 9999;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.6s ease-in-out;
        }

        .page-transition.active {
            opacity: 1;
            pointer-events: all;
        }

        .footer {
            display: flex;
            position: relative;
            z-index: 10;
            overflow: hidden;
        }

        .footer-left {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 15px 30px 15px 30px;
            width: 50%;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding-right: 20px;
        }

        .footer-left p {
            margin: 0;
            font-size: 16px;
            font-weight: 500;
        }

        .footer-right {
            background: #EAEBEC;
            padding: 15px 30px 15px 20px;
            width: 50%;
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        .footer-logos-image {
            height: 40px;
            width: auto;
            max-width: 100%;
            object-fit: contain;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .main-title {
                font-size: 2rem;
            }

            .subtitle {
                font-size: 1.2rem;
            }

            .login-btn {
                padding: 14px 40px;
                font-size: 1.2rem;
            }

            .header {
                padding: 10px 15px;
            }

            .logo {
                height: 40px;
            }

            .footer {
                flex-direction: column;
                gap: 10px;
                text-align: center;
            }

            .footer-logos-image {
                max-height: 35px;
            }
        }
    </style>
</head>
<body>
    <!-- Page Transition Overlay -->
    <div class="page-transition" id="pageTransition"></div>

    <!-- Header -->
    <div class="header">
        <div class="header-left">
            <!-- Replace these image sources with your actual logo paths -->
            <img src="{{ asset('images/logo-malaysia.png') }}" alt="Malaysia Logo" class="logo">
            <img src="{{ asset('images/umk-logo.png') }}" alt="UMK Logo" class="logo">
            <img src="{{ asset('images/logo-geric.png') }}" alt="GERIC Logo" class="logo">
        </div>
        <div class="header-right">
            <h3>Official Portal</h3>
            <p>Global Entrepreneurship Research and</p>
            <p>Innovation Centre</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-container">
        <div class="content">
            <h1 class="main-title">SISTEM PENGURUSAN LAPORAN</h1>
            <p class="subtitle">Portal khas untuk Pengurusan Laporan dan Permohonan Penyelidikan GERIC</p>
            <a href="{{ route('login') }}" class="login-btn">Log Masuk</a>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <div class="footer-left">
            <p>KEUSAHAWANAN TERAS KAMI • <em>ENTREPRENEURSHIP IS OUR THRUST</em></p>
        </div>
        <div class="footer-right">
            <!-- Single horizontal image with all footer logos - replace 'footer-logos.png' with your image -->
            <img src="{{ asset('images/footer-logos.png') }}" alt="Footer Logos" class="footer-logos-image">
        </div>
    </div>

    <script>
        // Smooth page transition when clicking login button
        document.addEventListener('DOMContentLoaded', function() {
            const loginBtn = document.querySelector('.login-btn');
            const pageTransition = document.getElementById('pageTransition');
            
            if (loginBtn) {
                loginBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetUrl = this.href;
                    
                    // Add fade out effect to body
                    document.body.classList.add('fade-out');
                    
                    // Show transition overlay
                    pageTransition.classList.add('active');
                    
                    // Navigate to login page after animation
                    setTimeout(function() {
                        window.location.href = targetUrl;
                    }, 600);
                });
            }
        });

        // Fade in effect when page loads
        window.addEventListener('load', function() {
            document.body.style.opacity = '0';
            setTimeout(function() {
                document.body.style.transition = 'opacity 0.5s ease-in-out';
                document.body.style.opacity = '1';
            }, 100);
        });
    </script>
</body>
</html>
