<!DOCTYPE html>
<html lang="en" data-theme="{{ session('dark_mode', 'light') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ayoub Games - @yield('title', 'Gaming Platform')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #3498db;
            --primary-color-rgb: 52, 152, 219;
            --secondary-color: #2ecc71;
            --background-color: #f8f9fa;
            --text-color: #333;
            --card-bg: white;
            --header-bg: white;
            --shadow: rgba(0, 0, 0, 0.1);
            --success-color: #2ecc71;
            --warning-color: #f39c12;
            --info-color: #3498db;
        }
        
        [data-theme="dark"] {
            --primary-color: #3498db;
            --primary-color-rgb: 52, 152, 219;
            --secondary-color: #2ecc71;
            --background-color: #121212;
            --text-color: #f8f9fa;
            --card-bg: #1e1e1e;
            --header-bg: #1e1e1e;
            --shadow: rgba(255, 255, 255, 0.1);
            --success-color: #2ecc71;
            --warning-color: #f39c12;
            --info-color: #3498db;
        }
        
        body {
            background-color: var(--background-color);
            color: var(--text-color);
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
        }
        
        .header {
            background-color: var(--header-bg);
            box-shadow: 0 2px 10px var(--shadow);
            position: sticky;
            top: 0;
            z-index: 1000;
            padding: 15px 0;
        }
        
        .logo {
            font-weight: 700;
            font-size: 24px;
            color: var(--primary-color);
            text-decoration: none;
            display: flex;
            align-items: center;
        }
        
        .logo i {
            font-size: 28px;
            margin-right: 8px;
        }
        
        .logo span {
            color: #ff4757; /* Red accent for better branding */
        }
        
        .nav-link {
            color: var(--text-color);
            font-weight: 500;
            margin: 0 10px;
            transition: color 0.3s;
            text-decoration: none;
        }
        
        .nav-link:hover {
            color: var(--primary-color);
        }
        
        .search-form {
            position: relative;
            width: 100%;
            max-width: 450px;
            margin: 0 auto;
        }
        
        .search-input {
            background-color: var(--background-color);
            border: 1px solid var(--shadow);
            color: var(--text-color);
            padding: 10px 50px 10px 20px;
            border-radius: 50px;
            width: 100%;
            font-size: 0.9rem;
            transition: all 0.3s;
        }
        
        .search-input:focus {
            box-shadow: 0 0 0 3px rgba(var(--primary-color-rgb), 0.2);
            border-color: var(--primary-color);
            outline: none;
        }
        
        .search-input::placeholder {
            color: rgba(var(--text-color), 0.6);
        }
        
        .search-btn {
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            background: var(--primary-color);
            border: none;
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .search-btn:hover {
            background: darken(var(--primary-color), 10%);
        }
        
        .dark-mode-toggle {
            cursor: pointer;
            font-size: 1.2rem;
            color: var(--text-color);
            transition: color 0.3s;
            background: none;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .dark-mode-toggle:hover {
            color: var(--primary-color);
            background-color: var(--background-color);
        }
        
        .user-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .auth-btn {
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.3s;
        }
        
        .login-btn {
            background: transparent;
            color: var(--text-color);
            border: 1px solid var(--primary-color);
        }
        
        .login-btn:hover {
            background-color: var(--primary-color);
            color: white;
        }
        
        .register-btn {
            background-color: var(--primary-color);
            color: white;
            border: 1px solid var(--primary-color);
        }
        
        .register-btn:hover {
            background-color: darken(var(--primary-color), 10%);
        }
        
        .category-card {
            background-color: var(--card-bg);
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 4px 15px var(--shadow);
            cursor: pointer;
            margin-bottom: 20px;
        }
        
        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px var(--shadow);
        }
        
        .category-card img {
            width: 100%;
            height: 120px;
            object-fit: cover;
        }
        
        .category-card .card-body {
            padding: 15px;
        }
        
        .category-card .card-title {
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .game-card {
            background-color: var(--card-bg);
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 4px 15px var(--shadow);
            height: 100%;
            margin-bottom: 20px;
        }
        
        .game-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px var(--shadow);
        }
        
        .game-card .game-image {
            position: relative;
            height: 180px;
            overflow: hidden;
        }
        
        .game-card img, .game-card video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s;
        }
        
        .game-card:hover img {
            transform: scale(1.05);
        }
        
        .game-card .card-body {
            padding: 15px;
        }
        
        .game-card .card-title {
            font-weight: bold;
            margin-bottom: 10px;
        }
        
        .stars {
            color: #f1c40f;
            margin-bottom: 10px;
        }
        
        .section-title {
            font-weight: bold;
            margin-bottom: 30px;
            position: relative;
            display: inline-block;
            padding-bottom: 10px;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 3px;
            background-color: var(--primary-color);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: darken(var(--primary-color), 10%);
            border-color: darken(var(--primary-color), 10%);
        }
        
        footer {
            background-color: var(--card-bg);
            padding: 30px 0;
            margin-top: 50px;
            box-shadow: 0 -2px 10px var(--shadow);
        }
    </style>
    
    @yield('styles')
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-2 col-md-3 col-6">
                    <a href="{{ route('home') }}" class="logo">
                        <i class="fas fa-gamepad"></i> Ayoub<span>Games</span>
                    </a>
                </div>
                <div class="col-lg-7 col-md-6 col-12 py-2 py-md-0">
                    <form action="{{ route('search') }}" method="GET" class="search-form" id="searchForm">
                        <input type="text" class="form-control search-input" placeholder="Search our 90,000 games..." name="query" id="searchInput">
                        <button type="submit" class="search-btn">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
                <div class="col-lg-3 col-md-3 col-6 d-flex justify-content-end align-items-center">
                    <button class="dark-mode-toggle me-3" id="darkModeToggle" aria-label="Toggle dark mode">
                        <i class="fas fa-{{ session('dark_mode', 'light') === 'dark' ? 'sun' : 'moon' }}"></i>
                    </button>
                    <div class="user-actions">
                        <a href="{{ route('login') }}" class="auth-btn login-btn d-none d-md-inline-block">Log in</a>
                        <a href="{{ route('register') }}" class="auth-btn register-btn">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer mt-auto">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <a href="{{ route('home') }}" class="logo mb-3 d-block">
                        <i class="fas fa-gamepad"></i> Ayoub<span>Games</span>
                    </a>
                    <p class="mb-3">Your ultimate destination for free online games. Discover, download and play thousands of games.</p>
                </div>
                <div class="col-md-2">
                    <h5>Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}" class="nav-link">Home</a></li>
                        <li><a href="{{ route('games') }}" class="nav-link">Games</a></li>
                        <li><a href="#" class="nav-link">About</a></li>
                        <li><a href="#" class="nav-link">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Categories</h5>
                    <ul class="list-unstyled">
                        @php
                            $footerCategories = App\Models\Category::withCount('games')->orderByDesc('games_count')->take(4)->get();
                        @endphp
                        @foreach($footerCategories as $category)
                        <li>
                            <a href="{{ route('games') }}?category={{ $category->id }}" class="nav-link">
                                {{ $category->name }} ({{ $category->games_count }})
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Follow Us</h5>
                    <div class="d-flex social-links">
                        <a href="#" class="me-2 social-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="me-2 social-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="me-2 social-link"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <div class="row mt-4 border-top pt-3">
                <div class="col-md-6">
                    <p class="mb-0">&copy; {{ date('Y') }} AyoubGames. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0">
                        <a href="#" class="text-decoration-none me-3">Privacy Policy</a>
                        <a href="#" class="text-decoration-none">Terms of Service</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap & jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Set up CSRF token for AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            // Dark mode toggle
            $('#darkModeToggle').click(function() {
                const currentTheme = $('html').attr('data-theme');
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                
                $('html').attr('data-theme', newTheme);
                $(this).find('i').toggleClass('fa-moon fa-sun');
                
                // Save preference via AJAX
                $.post('{{ route("toggle.theme") }}', { theme: newTheme });
            });
        });
    </script>
    
    @yield('scripts')
</body>
</html> 