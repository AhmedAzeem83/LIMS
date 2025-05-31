<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LIMS | Oil & Gas Laboratory</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background: linear-gradient(135deg, #f3f4f6 0%, #e0e7ef 100%);
            min-height: 100vh;
            margin: 0;
        }
        .lims-header {
            background: #003366;
            color: #fff;
            padding: 2rem 0 1rem 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .lims-header .icon {
            font-size: 3rem;
            color: #ff2d20;
            animation: drop 1.2s cubic-bezier(.68,-0.55,.27,1.55) infinite alternate;
        }
        @keyframes drop {
            0% { transform: translateY(0);}
            100% { transform: translateY(10px);}
        }
        .lims-title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-top: 0.5rem;
            letter-spacing: 1px;
        }
        .lims-subtitle {
            font-size: 1.2rem;
            color: #cfd8dc;
            margin-bottom: 1rem;
        }
        .lims-card {
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0 8px 32px rgba(0,0,0,0.08);
            max-width: 650px;
            margin: 2rem auto;
            padding: 2.5rem 2.5rem 2rem 2.5rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .lims-card .bi {
            font-size: 2.5rem;
            color: #003366;
            margin-bottom: 1rem;
            transition: transform 0.3s;
        }
        .lims-card .bi:hover {
            transform: rotate(20deg) scale(1.2);
            color: #ff2d20;
        }
        .lims-btn {
            display: inline-block;
            margin: 1rem 0.5rem 0 0.5rem;
            padding: 0.75rem 2rem;
            font-size: 1.1rem;
            border-radius: 2rem;
            border: none;
            background: linear-gradient(90deg, #003366 60%, #005fa3 100%);
            color: #fff;
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 2px 12px rgba(0,0,0,0.07);
            transition: background 0.2s, transform 0.2s;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }
        .lims-btn i {
            margin-right: 0.5rem;
        }
        .lims-btn:hover {
            background: linear-gradient(90deg, #ff2d20 60%, #ff5e3a 100%);
            color: #fff;
            transform: translateY(-2px) scale(1.04);
        }
        .lims-btn:active {
            transform: scale(0.98);
        }
        .lims-features {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1.5rem;
            margin: 2rem 0 1rem 0;
        }
        .feature-card {
            background: #f3f4f6;
            border-radius: 1rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            padding: 1.2rem 1.5rem;
            min-width: 180px;
            max-width: 220px;
            flex: 1 1 180px;
            text-align: center;
            transition: box-shadow 0.2s, transform 0.2s;
            cursor: pointer;
        }
        .feature-card:hover {
            box-shadow: 0 6px 24px rgba(0,51,102,0.12);
            transform: translateY(-4px) scale(1.04);
            background: #e0e7ef;
        }
        .feature-card i {
            font-size: 2rem;
            color: #003366;
            margin-bottom: 0.5rem;
            display: block;
        }
        .feature-title {
            font-weight: 600;
            margin-bottom: 0.3rem;
            color: #003366;
        }
        .feature-desc {
            font-size: 0.98rem;
            color: #444;
        }
        .lims-footer {
            text-align: center;
            color: #888;
            margin: 2rem 0 1rem 0;
            font-size: 0.95rem;
        }
        /* Responsive */
        @media (max-width: 700px) {
            .lims-card {
                padding: 1.2rem 0.7rem;
            }
            .lims-features {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="lims-header">
        <i class="bi bi-droplet-half icon"></i>
        <div class="lims-title">LIMS - Oil & Gas Laboratory</div>
        <div class="lims-subtitle">Laboratory Information Management System for Oil & Gas Analysis</div>
    </div>
    <div class="lims-card">
        <i class="bi bi-gear-wide-connected" title="System Portal"></i>
        <h2>Welcome to the Oil & Gas LIMS Portal</h2>
        <p>
            Manage all laboratory operations for oil and gas samples: tracking, testing, reporting, and more.<br>
            <span style="color:#005fa3;font-weight:600;">Experience a modern, secure, and efficient workflow.</span>
        </p>
        <div class="lims-features">
            <a href="{{ route('samples.index') }}" class="feature-card" tabindex="0" aria-label="Sample Tracking">
                <i class="bi bi-droplet-half"></i>
                <div class="feature-title">Sample Tracking</div>
            </a>
            <a href="{{ route('tests.index') }}" class="feature-card" tabindex="0" aria-label="Test Management">
                <i class="bi bi-flask"></i>
                <div class="feature-title">Test Management</div>
            </a>
            <a href="{{ route('reports.index') }}" class="feature-card" tabindex="0" aria-label="Reporting">
                <i class="bi bi-clipboard-data"></i>
                <div class="feature-title">Reporting</div>
            </a>
            <a href="{{ route('users.index') }}" class="feature-card" tabindex="0" aria-label="Secure Access">
                <i class="bi bi-shield-lock"></i>
                <div class="feature-title">Secure Access</div>
            </a>
        </div>
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" class="lims-btn"><i class="bi bi-speedometer2"></i> Go to Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="lims-btn"><i class="bi bi-box-arrow-in-right"></i> Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="lims-btn" style="background:linear-gradient(90deg,#ff2d20 60%,#ff5e3a 100%);"><i class="bi bi-person-plus"></i> Register</a>
                @endif
            @endauth
        @endif
    </div>
    <div class="lims-footer">
        &copy; {{ date('Y') }} LIMS Oil & Gas Laboratory &mdash; Powered by Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
    </div>
    <script>
        // Simple interactive effect for feature cards (optional)
        document.querySelectorAll('.feature-card').forEach(card => {
            card.addEventListener('keydown', e => {
                if (e.key === 'Enter' || e.key === ' ') {
                    card.classList.toggle('active');
                }
            });
        });
    </script>
</body>
</html>
