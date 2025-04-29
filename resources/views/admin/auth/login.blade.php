<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login - Ayoub Games</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #2557d3;
            --text-color: #333;
            --background-color: #f8f9fa;
            --card-bg: white;
            --shadow: rgba(0, 0, 0, 0.08);
            --error-color: #dc3545;
        }
        
        body {
            background-color: var(--background-color);
            color: var(--text-color);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .login-container {
            width: 100%;
            max-width: 1100px;
            background-color: var(--card-bg);
            border-radius: 20px;
            box-shadow: 0 15px 35px var(--shadow);
            overflow: hidden;
            display: flex;
            flex-direction: row;
        }
        
        .login-form-section {
            width: 50%;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .slider-section {
            width: 50%;
            background-color: #f0f7ff;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
        }
        
        .welcome-text {
            margin-bottom: 40px;
        }
        
        .welcome-text h1 {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--text-color);
        }
        
        .welcome-text p {
            color: #666;
            font-size: 16px;
            margin-bottom: 20px;
            opacity: 0.9;
            max-width: 90%;
        }
        
        .form-input {
            position: relative;
            margin-bottom: 24px;
        }
        
        .form-input input {
            width: 100%;
            padding: 16px 20px;
            border: 1px solid #e1e1e1;
            border-radius: 12px;
            font-size: 15px;
            outline: none;
            transition: all 0.3s;
            background-color: #fafafa;
            color: var(--text-color);
        }
        
        .form-input input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 87, 211, 0.15);
            background-color: #fff;
        }
        
        .form-input input.is-invalid {
            border-color: var(--error-color);
            background-color: #fff;
        }
        
        .invalid-feedback {
            display: block;
            color: var(--error-color);
            font-size: 12px;
            margin-top: 5px;
            font-weight: 500;
        }
        
        .form-check {
            margin-bottom: 20px;
        }
        
        .form-check-input {
            border-radius: 4px;
            width: 18px;
            height: 18px;
        }
        
        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .form-check-label {
            font-size: 14px;
            padding-left: 5px;
        }
        
        .login-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 16px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            transition: all 0.3s;
            margin-bottom: 20px;
        }
        
        .login-btn:hover {
            background-color: #1a45b0;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(37, 87, 211, 0.2);
        }
        
        .login-btn:active {
            transform: translateY(0);
        }
        
        .visit-site-btn {
            background-color: transparent;
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
            border-radius: 12px;
            padding: 16px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            transition: all 0.3s;
            text-align: center;
            text-decoration: none;
            display: block;
        }
        
        .visit-site-btn:hover {
            background-color: rgba(37, 87, 211, 0.05);
            color: #1a45b0;
        }
        
        .slider-container {
            width: 100%;
            height: 400px;
            position: relative;
            overflow: hidden;
        }
        
        .slide {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1s ease-in-out;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        
        .slide.active {
            opacity: 1;
        }
        
        .slide img {
            max-width: 300px;
            max-height: 300px;
            margin-bottom: 20px;
            object-fit: contain;
        }
        
        .slide-text {
            font-size: 18px;
            font-weight: 500;
            color: #333;
            margin-top: 15px;
        }
        
        .slider-dots {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        
        .dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: #d0d0d0;
            margin: 0 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .dot.active {
            background-color: var(--primary-color);
            transform: scale(1.2);
        }
        
        @media (max-width: 992px) {
            .login-form-section {
                padding: 40px;
            }
        }
        
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                max-width: 500px;
            }
            
            .login-form-section,
            .slider-section {
                width: 100%;
                padding: 30px;
            }
            
            .slider-section {
                display: none;
            }
            
            .welcome-text h1 {
                font-size: 30px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Login Form Section -->
        <div class="login-form-section">
            <div class="welcome-text">
                <h1>Welcome back!</h1>
                <p>Simplify your workflow and boost your productivity with Ayoub Games admin panel.</p>
            </div>
            
            <form action="{{ route('admin.login.submit') }}" method="POST">
                @csrf
                <div class="form-input">
                    <input type="email" class="{{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                    @if($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>
                
                <div class="form-input">
                    <input type="password" class="{{ $errors->has('password') ? 'is-invalid' : '' }}" id="password" name="password" placeholder="Password">
                    @if($errors->has('password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>
                
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                    <label class="form-check-label" for="remember">
                        Remember me
                    </label>
                </div>
                
                <button type="submit" class="login-btn">Login</button>
            </form>
            
            <a href="{{ route('home') }}" class="visit-site-btn">
                Visit Website
            </a>
        </div>
        
        <!-- Slider Section -->
        <div class="slider-section">
            <div class="slider-container">
                <div class="slide active">
                    <img src="{{ asset('storage/login-images/image1.svg') }}" alt="Game Management">
                    <div class="slide-text">Manage your game content with ease</div>
                </div>
                <div class="slide">
                    <img src="{{ asset('storage/login-images/image2.svg') }}" alt="User Management">
                    <div class="slide-text">Track and manage user activity</div>
                </div>
                <div class="slide">
                    <img src="{{ asset('storage/login-images/image3.svg') }}" alt="Analytics">
                    <div class="slide-text">View detailed analytics and reports</div>
                </div>
            </div>
            
            <div class="slider-dots">
                <div class="dot active" data-slide="0"></div>
                <div class="dot" data-slide="1"></div>
                <div class="dot" data-slide="2"></div>
            </div>
        </div>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Setup AJAX CSRF token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            // Image Slider
            let currentSlide = 0;
            const slides = $('.slide');
            const dots = $('.dot');
            const totalSlides = slides.length;
            
            function showSlide(index) {
                slides.removeClass('active');
                dots.removeClass('active');
                
                $(slides[index]).addClass('active');
                $(dots[index]).addClass('active');
                currentSlide = index;
            }
            
            // Dot navigation
            dots.click(function() {
                const slideIndex = $(this).data('slide');
                showSlide(slideIndex);
            });
            
            // Auto slide
            setInterval(function() {
                currentSlide = (currentSlide + 1) % totalSlides;
                showSlide(currentSlide);
            }, 5000);
        });
    </script>
</body>
</html> 