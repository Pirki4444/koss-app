<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Kos-Kosan')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Space Grotesk', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            line-height: 1.5;
            color: #000;
            background-color: #FAFAFA;
            background-image: 
                repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(0,0,0,.03) 35px, rgba(0,0,0,.03) 70px);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        header {
            background-color: #FFE951;
            color: #000;
            padding: 2rem 0;
            border-bottom: 6px solid #000;
            box-shadow: 8px 8px 0px #000;
            margin-bottom: 3rem;
            position: relative;
        }

        header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: repeating-linear-gradient(
                90deg,
                transparent,
                transparent 10px,
                rgba(0,0,0,0.05) 10px,
                rgba(0,0,0,0.05) 20px
            );
            pointer-events: none;
        }

        header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            letter-spacing: -1px;
            text-transform: uppercase;
            position: relative;
        }

        nav {
            margin-top: 1rem;
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            position: relative;
        }

        nav a {
            color: #000;
            text-decoration: none;
            padding: 0.7rem 1.5rem;
            border: 4px solid #000;
            background-color: #fff;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
            box-shadow: 4px 4px 0px #000;
            transition: all 0.1s ease;
            position: relative;
        }

        nav a:hover {
            transform: translate(2px, 2px);
            box-shadow: 2px 2px 0px #000;
        }

        nav a:active {
            transform: translate(4px, 4px);
            box-shadow: 0px 0px 0px #000;
        }

        main {
            padding: 2rem 0 4rem 0;
            min-height: calc(100vh - 300px);
        }

        footer {
            background-color: #000;
            color: #FFE951;
            text-align: center;
            padding: 2rem 0;
            margin-top: 4rem;
            border-top: 6px solid #FFE951;
            font-weight: 600;
        }

        .alert {
            padding: 1.2rem 1.5rem;
            margin-bottom: 2rem;
            border: 4px solid #000;
            box-shadow: 6px 6px 0px #000;
            font-weight: 600;
            position: relative;
        }

        .alert-success {
            background-color: #A8FF76;
            color: #000;
        }

        .alert-error {
            background-color: #FF6B9D;
            color: #000;
        }

        .alert::before {
            content: '⚠';
            font-size: 1.5rem;
            margin-right: 0.5rem;
        }

        .alert-success::before {
            content: '✓';
        }

        .btn {
            display: inline-block;
            padding: 0.9rem 2rem;
            text-decoration: none;
            border: 4px solid #000;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-family: 'Space Grotesk', sans-serif;
            transition: all 0.1s ease;
            box-shadow: 6px 6px 0px #000;
        }

        .btn:hover {
            transform: translate(3px, 3px);
            box-shadow: 3px 3px 0px #000;
        }

        .btn:active {
            transform: translate(6px, 6px);
            box-shadow: 0px 0px 0px #000;
        }

        .btn-primary {
            background-color: #76D9FF;
            color: #000;
        }

        .btn-success {
            background-color: #A8FF76;
            color: #000;
        }

        .btn-secondary {
            background-color: #E0E0E0;
            color: #000;
        }

        .btn:disabled {
            background-color: #999;
            cursor: not-allowed;
            opacity: 0.6;
        }

        .btn:disabled:hover {
            transform: none;
            box-shadow: 6px 6px 0px #000;
        }

        h2 {
            font-size: 2rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: -0.5px;
            margin-bottom: 1rem;
        }

        h3 {
            font-size: 1.5rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: -0.5px;
        }

        p {
            font-weight: 500;
        }

        /* Neo-brutalism Card Base */
        .card {
            background: #fff;
            border: 4px solid #000;
            box-shadow: 8px 8px 0px #000;
            padding: 1.5rem;
            transition: all 0.2s ease;
        }

        .card:hover {
            transform: translate(4px, 4px);
            box-shadow: 4px 4px 0px #000;
        }
    </style>
    @stack('styles')
</head>
<body>
    <header>
        <div class="container">
            <h1>🏠 KOS-KOSAN</h1>
            <nav>
                <a href="{{ route('home') }}">🏠 Beranda</a>
                <a href="{{ route('rooms.available') }}">✨ Kamar Tersedia</a>
                <a href="{{ route('bookings.index') }}">📋 Pemesanan</a>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <footer>
        <div class="container">
            <p>© {{ date('Y') }} KOS-KOSAN SYSTEM • CLOUD COMPUTING PROJECT</p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
