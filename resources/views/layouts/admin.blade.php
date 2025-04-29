<!DOCTYPE html>
<html lang="en" data-theme="{{ session('dark_mode', 'light') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - Ayoub Games</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* Base Variables - Light Theme */
        :root {
            --text-color: #333;
            --body-bg: #f5f8fa;
            --card-bg: #fff;
            --card-border: 1px solid #e5e5e5;
            --card-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            --card-header-bg: #f8f9fa;
            --input-bg: #fff;
            --input-border: 1px solid #ced4da;
            --border-color: #e5e5e5;
            --navbar-bg: #fff;
            --sidebar-bg: #fff;
            --sidebar-active-bg: rgba(37, 87, 211, 0.1);
            --sidebar-hover-bg: rgba(0, 0, 0, 0.05);
            --primary-color: #2557d3;
            --primary-hover: #1a45b0;
            --secondary-color: #3bc9db;
            --success-color: #2ecc71;
            --info-color: #3498db;
            --warning-color: #f39c12;
            --danger-color: #e74c3c;
            --dark-color: #343a40;
            --light-color: #f8f9fa;
            --gray-color: #6c757d;
            --sidebar-text: #555;
            --sidebar-active: #f2f6ff;
            --sidebar-active-text: #2557d3;
            --header-bg: white;
            --shadow: rgba(0, 0, 0, 0.05);
            --btn-hover-transform: translateY(-2px);
        }
        
        /* Dark Theme Variables */
        [data-theme="dark"] {
            --text-color: #e1e1e1;
            --body-bg: #1a1d21;
            --card-bg: #252830;
            --card-border: 1px solid #32363e;
            --card-shadow: 0 0.125rem 0.5rem rgba(0, 0, 0, 0.15);
            --card-header-bg: #2b303b;
            --input-bg: #2b303b;
            --input-border: 1px solid #3a3f48;
            --border-color: #32363e;
            --navbar-bg: #252830;
            --sidebar-bg: #252830;
            --primary-color: #2557d3;
            --primary-hover: #1a45b0;
            --secondary-color: #3bc9db;
            --sidebar-active-bg: rgba(92, 128, 209, 0.2);
            --sidebar-hover-bg: rgba(255, 255, 255, 0.05);
            --sidebar-text: #aaaaaa;
            --sidebar-active: #2557d3;
            --sidebar-active-text: #5c80d1;
            --header-bg: #1e1e1e;
            --shadow: rgba(255, 255, 255, 0.05);
            --success-color: #2ecc71;
            --danger-color: #e74c3c;
            --warning-color: #f39c12;
            --info-color: #3498db;
            --btn-bg: #2a2a2a;
            --user-dropdown-bg: #2a2a2a;
        }
        
        /* Apply theme colors */
        body {
            background-color: var(--body-bg);
            color: var(--text-color);
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
            overflow-x: hidden;
            position: relative;
            min-height: 100vh;
        }
        
        .card {
            background-color: var(--card-bg);
            color: var(--text-color);
            border: var(--card-border);
            box-shadow: var(--card-shadow);
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .card-header {
            background-color: var(--card-header-bg);
            border-bottom: var(--card-border);
            color: var(--text-color);
            padding: 1rem;
            font-weight: 600;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        
        .table {
            color: var(--text-color);
        }
        
        .table > :not(caption) > * > * {
            background-color: var(--card-bg);
            border-bottom-color: var(--border-color);
        }
        
        .table-hover > tbody > tr:hover > * {
            background-color: var(--sidebar-hover-bg);
        }
        
        .form-control, .form-select {
            background-color: var(--input-bg);
            border: var(--input-border);
            color: var(--text-color);
        }
        
        .form-control:focus, .form-select:focus {
            background-color: var(--input-bg);
            color: var(--text-color);
        }
        
        .input-group-text {
            background-color: var(--card-header-bg);
            border: var(--input-border);
            color: var(--text-color);
        }
        
        /* Navbar */
        .navbar {
            background-color: var(--navbar-bg);
            border-bottom: var(--card-border);
        }
        
        /* Fix for dark mode text visibility */
        [data-theme="dark"] .card,
        [data-theme="dark"] .card-body,
        [data-theme="dark"] .card-header,
        [data-theme="dark"] .modal-content,
        [data-theme="dark"] .modal-body,
        [data-theme="dark"] .dropdown-menu,
        [data-theme="dark"] .table {
            color: var(--text-color);
        }
        
        [data-theme="dark"] .text-dark {
            color: var(--text-color) !important;
        }
        
        [data-theme="dark"] .text-muted {
            color: #9ca3af !important;
        }
        
        [data-theme="dark"] .table {
            border-color: var(--border-color);
        }
        
        [data-theme="dark"] .table thead th {
            border-bottom-color: var(--border-color);
        }
        
        /* Sidebar */
        #sidebar {
            width: 80px;
            background-color: var(--sidebar-bg);
            color: var(--sidebar-text);
            min-height: 100vh;
            transition: all 0.3s;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 999;
            box-shadow: 0 0 15px var(--shadow);
            padding-top: 10px;
            overflow-x: hidden;
        }
        
        #sidebar.active {
            width: 240px;
        }
        
        #sidebar .sidebar-header {
            padding: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 15px;
            min-height: 70px;
            position: relative;
        }
        
        #sidebar .sidebar-header img {
            width: 40px;
            height: 40px;
            object-fit: contain;
        }
        
        #sidebar .sidebar-header .logo-text {
            font-size: 1.1rem;
            font-weight: 600;
            margin-left: 12px;
            color: var(--text-color);
            opacity: 0;
            display: none;
            white-space: nowrap;
        }
        
        #sidebar.active .sidebar-header .logo-text {
            opacity: 1;
            display: block;
        }

        #sidebar ul.components {
            padding: 0;
            margin-top: 10px;
        }
        
        #sidebar ul li {
            margin-bottom: 5px;
            position: relative;
        }
        
        #sidebar ul li a {
            padding: 15px 20px;
            display: flex;
            align-items: center;
            color: var(--sidebar-text);
            text-decoration: none;
            transition: all 0.3s;
            border-radius: 0;
            font-weight: 500;
            font-size: 0.95rem;
            white-space: nowrap;
            overflow: hidden;
        }
        
        #sidebar ul li a i {
            min-width: 20px;
            text-align: center;
            font-size: 1.2rem;
            margin-right: 25px;
            transition: margin 0.3s;
        }
        
        #sidebar:not(.active) ul li a i {
            margin-right: 0;
            margin-left: 10px;
        }
        
        #sidebar ul li a:hover {
            color: var(--sidebar-active-text);
            background-color: var(--sidebar-active);
        }
        
        #sidebar ul li.active a {
            color: var(--sidebar-active-text);
            background-color: var(--sidebar-active);
            font-weight: 600;
        }
        
        #sidebar ul li.active a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background-color: var(--primary-color);
        }
        
        #sidebar .menu-label {
            opacity: 0;
            display: none;
            transition: opacity 0.3s;
        }
        
        #sidebar.active .menu-label {
            opacity: 1;
            display: inline;
        }
        
        #sidebar .sidebar-footer {
            padding: 15px;
            position: absolute;
            bottom: 0;
            width: 100%;
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: center;
            flex-direction: column;
        }
        
        #sidebar:not(.active) .sidebar-footer .btn span {
            display: none;
        }
        
        #sidebar:not(.active) .sidebar-footer .btn {
            padding: 8px;
            min-width: 40px;
            justify-content: center;
        }
        
        #sidebar:not(.active) .sidebar-footer .btn i {
            margin-right: 0;
        }
        
        /* Header */
        #content {
            width: calc(100% - 80px);
            margin-left: 80px;
            transition: all 0.3s;
        }
        
        #content.active {
            width: calc(100% - 240px);
            margin-left: 240px;
        }
        
        .navbar {
            background-color: var(--header-bg);
            box-shadow: 0 1px 10px var(--shadow);
            padding: 10px 20px;
            margin-bottom: 30px;
            position: sticky;
            top: 0;
            z-index: 998;
            height: 70px;
        }
        
        .menu-toggle {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border-radius: 8px;
            background-color: var(--sidebar-active);
            border: none;
            transition: all 0.3s;
        }
        
        [data-theme="dark"] .menu-toggle {
            background-color: var(--btn-bg);
            color: var(--text-color);
        }
        
        .menu-toggle:hover {
            background-color: var(--sidebar-active);
            transform: translateY(-2px);
        }
        
        [data-theme="dark"] .menu-toggle:hover {
            background-color: var(--primary-color);
            color: white;
        }
        
        .menu-toggle:active {
            transform: translateY(0);
        }
        
        .menu-toggle i {
            color: var(--primary-color);
            font-size: 1.2rem;
        }
        
        .dark-mode-toggle {
            cursor: pointer;
            font-size: 1.1rem;
            color: var(--text-color);
            transition: all 0.3s;
            background-color: var(--sidebar-active);
            height: 40px;
            width: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
        }
        
        [data-theme="dark"] .dark-mode-toggle {
            background-color: var(--btn-bg);
        }
        
        .dark-mode-toggle:hover {
            transform: translateY(-2px);
        }
        
        [data-theme="dark"] .dark-mode-toggle:hover {
            background-color: var(--primary-color);
            color: white;
        }
        
        .dark-mode-toggle:active {
            transform: translateY(0);
        }
        
        /* User dropdown */
        .user-dropdown {
            display: inline-flex;
            align-items: center;
            background-color: var(--sidebar-active);
            padding: 8px 16px 8px 8px;
            cursor: pointer;
            transition: all 0.3s;
            border-radius: 8px;
        }
        
        [data-theme="dark"] .user-dropdown {
            background-color: var(--user-dropdown-bg);
            color: white;
        }
        
        .user-dropdown span {
            font-weight: 500;
            display: none;
        }
        
        @media (min-width: 576px) {
            .user-dropdown span {
                display: inline;
                margin-left: 10px;
            }
        }
        
        [data-theme="dark"] .user-dropdown span {
            color: white;
        }
        
        .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            object-fit: cover;
        }
        
        .navbar .dropdown-menu {
            border-radius: 10px;
            box-shadow: 0 5px 15px var(--shadow);
            border: none;
            background-color: var(--card-bg);
            margin-top: 10px;
            padding: 10px;
        }
        
        .navbar .dropdown-item {
            color: var(--text-color);
            padding: 8px 15px;
            border-radius: 5px;
            transition: all 0.2s;
        }
        
        .navbar .dropdown-item:hover {
            background-color: var(--sidebar-active);
            color: var(--primary-color);
        }
        
        .navbar .dropdown-divider {
            border-color: var(--border-color);
        }
        
        /* Responsive fixes */
        @media (max-width: 1199.98px) {
            .card-body {
                padding: 20px;
            }
            
            .navbar {
                padding: 10px 15px;
            }
        }
        
        @media (max-width: 991.98px) {
            #sidebar {
                width: 0;
                overflow: hidden;
            }
            
            #sidebar.active {
                width: 240px;
            }
            
            #content {
                width: 100%;
                margin-left: 0;
            }
            
            #content.active {
                width: calc(100% - 240px);
                margin-left: 240px;
            }
            
            .card-body {
                padding: 15px;
            }
        }
        
        @media (max-width: 767.98px) {
            .navbar {
                height: auto;
                padding: 10px;
            }
            
            .container-fluid {
                padding-left: 10px;
                padding-right: 10px;
            }
            
            main.container-fluid {
                padding: 10px;
            }
            
            .card-header {
                padding: 15px;
            }
            
            .card-body {
                padding: 15px;
            }
            
            .user-dropdown {
                padding: 8px;
            }
            
            .menu-toggle, .dark-mode-toggle {
                width: 36px;
                height: 36px;
            }
        }
        
        @media (max-width: 575.98px) {
            #content.active {
                margin-left: 0;
                width: 100%;
            }
            
            #sidebar.active {
                width: 100%;
            }
            
            .card {
                margin-bottom: 15px;
            }
            
            .card-header {
                padding: 12px 15px;
            }
            
            .card-body {
                padding: 12px;
            }
        }
        
        /* Cards */
        .card {
            background-color: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 4px 15px var(--shadow);
            margin-bottom: 25px;
            border: none;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px var(--shadow);
        }
        
        .card-header {
            background-color: transparent;
            border-bottom: 1px solid var(--border-color);
            font-weight: 600;
            padding: 18px 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .card-header h5, .card-header h6 {
            margin-bottom: 0;
            font-weight: 600;
        }
        
        .card-body {
            padding: 22px;
        }
        
        /* Responsive Table */
        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
        }
        
        /* Images in cards */
        .img-fluid {
            max-width: 100%;
            height: auto;
        }
        
        /* Keep all other existing styles */
        // ... existing code ...
        
        .sidebar-close {
            display: none;
            position: absolute;
            right: 15px;
            top: 22px;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: rgba(0,0,0,0.05);
            border: none;
            cursor: pointer;
            align-items: center;
            justify-content: center;
            color: var(--text-color);
            font-size: 16px;
            transition: all 0.2s ease;
            z-index: 10;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            opacity: 0;
            visibility: hidden;
        }
        
        #sidebar.active .sidebar-close {
            opacity: 1;
            visibility: visible;
        }
        
        .sidebar-close:hover {
            background-color: var(--primary-color);
            color: white;
            transform: scale(1.1);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }
        
        .sidebar-close:active {
            transform: scale(0.95);
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        
        [data-theme="dark"] .sidebar-close {
            background-color: rgba(255,255,255,0.1);
            color: #fff;
        }
        
        [data-theme="dark"] .sidebar-close:hover {
            background-color: var(--primary-color);
        }
        
        /* Display close button only on mobile */
        @media (min-width: 992px) {
            .sidebar-close {
                display: none !important;
            }
        }
        
        @media (max-width: 991.98px) {
            #sidebar.active .sidebar-close {
                display: flex;
            }
        }
        
        /* Content area styling */
        .container-fluid {
            padding: 0 25px;
        }
        
        main.container-fluid {
            padding-bottom: 40px;
        }
        
        /* Table styling */
        .table {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
        }
        
        .table thead th {
            font-weight: 600;
            padding: 12px 15px;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-color);
            background-color: rgba(0,0,0,0.02);
            white-space: nowrap;
        }
        
        [data-theme="dark"] .table thead th {
            background-color: rgba(255,255,255,0.05);
        }
        
        .table td {
            padding: 12px 15px;
            vertical-align: middle;
            border-top: none;
            border-bottom: 1px solid var(--border-color);
        }
        
        .table-hover tbody tr:hover {
            background-color: rgba(0,0,0,0.01);
        }
        
        [data-theme="dark"] .table-hover tbody tr:hover {
            background-color: rgba(255,255,255,0.03);
        }
        
        /* Buttons styling */
        .btn {
            border-radius: 8px;
            padding: 8px 16px;
            font-weight: 500;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }
        
        .btn-sm {
            padding: 5px 12px;
            font-size: 0.85rem;
            border-radius: 6px;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(37, 87, 211, 0.2);
        }
        
        .btn-primary:active {
            transform: translateY(0);
            box-shadow: none;
        }
        
        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }
        
        .btn i {
            font-size: 0.9rem;
        }
        
        /* Forms styling */
        .form-control, .form-select {
            background-color: var(--background-color);
            border: 1px solid var(--border-color);
            color: var(--text-color);
            border-radius: 8px;
            padding: 10px 15px;
            transition: all 0.3s;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 87, 211, 0.15);
        }
        
        .form-label {
            font-weight: 500;
            margin-bottom: 8px;
            color: var(--text-color);
        }
        
        /* Dashboard stats */
        .stats-card {
            padding: 20px;
            border-radius: 12px;
            background-color: var(--card-bg);
            box-shadow: 0 4px 15px var(--shadow);
            transition: all 0.3s;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px var(--shadow);
        }
        
        .stats-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            border-radius: 10px;
            background-color: rgba(37, 87, 211, 0.1);
            color: var(--primary-color);
            font-size: 1.4rem;
            margin-bottom: 15px;
        }
        
        .stats-number {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 5px;
            color: var(--text-color);
        }
        
        .stats-label {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 0;
        }
        
        [data-theme="dark"] .stats-label {
            color: #adb5bd;
        }
        
        /* Badges */
        .badge {
            padding: 5px 10px;
            font-weight: 500;
            border-radius: 6px;
            font-size: 0.75rem;
        }
        
        /* Section title */
        .section-title {
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-color);
        }
        
        /* Row spacing */
        .row {
            margin-bottom: 20px;
        }
        
        /* Link styles */
        a {
            color: var(--primary-color);
            text-decoration: none;
            transition: color 0.2s;
        }
        
        a:hover {
            color: var(--primary-hover);
        }
        
        /* Alerts */
        .alert {
            border-radius: 8px;
            padding: 15px 20px;
            border: none;
            margin-bottom: 20px;
        }
        
        .alert-dismissible .btn-close {
            padding: 18px;
        }
        
        /* Action buttons group */
        .action-buttons {
            display: flex;
            gap: 8px;
            align-items: center;
        }
        
        /* Modal customization */
        .modal-content {
            background-color: var(--card-bg);
            color: var(--text-color);
            border: 0;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .modal-header {
            border-bottom: 1px solid var(--border-color);
            background-color: var(--card-header-bg);
            color: var(--text-color);
        }
        
        .search-dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            max-height: 300px;
            overflow-y: auto;
            z-index: 999;
            border-radius: 0 0 0.5rem 0.5rem;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
            display: none;
            background-color: var(--body-bg);
            border: 1px solid var(--border-color);
            border-top: none;
        }
    </style>
    
    @yield('styles')
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <img src="{{ asset('storage/logo.png') }}" alt="Ayoub Games Logo">
                <span class="logo-text">Online Games</span>
                <button class="sidebar-close" id="sidebarClose">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <ul class="list-unstyled components">
                <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span class="menu-label">Dashboard</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}#categories">
                        <i class="fas fa-folder"></i>
                        <span class="menu-label">Categories</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.games.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}#games">
                        <i class="fas fa-gamepad"></i>
                        <span class="menu-label">Games</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('home') }}" target="_blank">
                        <i class="fas fa-eye"></i>
                        <span class="menu-label">View Site</span>
                    </a>
                </li>
            </ul>
            
            <div class="sidebar-footer">
                <a href="{{ route('admin.profile') }}" class="btn btn-light w-100 mb-2">
                    <i class="fas fa-user me-2"></i>
                    <span>Edit Profile</span>
                </a>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-primary w-100">
                        <i class="fas fa-sign-out-alt me-2"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </nav>
        
        <!-- Page Content -->
        <div id="content">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="menu-toggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    
                    <div class="d-flex ms-auto align-items-center">
                        <div class="dark-mode-toggle me-3" id="darkModeToggle">
                            <i class="fas fa-{{ session('dark_mode', 'light') === 'dark' ? 'sun' : 'moon' }}"></i>
                        </div>
                        
                        <div class="dropdown">
                            <a href="#" class="user-dropdown d-flex align-items-center text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="https://ui-avatars.com/api/?name=Admin&background=2557d3&color=fff" alt="Admin" class="user-avatar">
                                <span>Admin</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="fas fa-user-circle me-2"></i> Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('admin.logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i> Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
            
            <!-- Main Content -->
            <main class="container-fluid px-4 pb-5">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Setup AJAX CSRF token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            // Sidebar toggle
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar, #content').toggleClass('active');
                
                // On mobile, prevent content scrolling when sidebar is open
                if (window.innerWidth < 992 && $('#sidebar').hasClass('active')) {
                    $('body').css('overflow', 'hidden');
                } else {
                    $('body').css('overflow', '');
                }
            });
            
            // Close sidebar with close button
            $('#sidebarClose').on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                $('#sidebar, #content').removeClass('active');
                $('body').css('overflow', '');
            });
            
            // Handle window resize
            $(window).resize(function() {
                if (window.innerWidth < 992) {
                    $('#sidebar').removeClass('active');
                    $('#content').removeClass('active');
                    $('body').css('overflow', '');
                }
            });
            
            // Close sidebar when clicking outside on mobile
            $(document).on('click touchstart', function(e) {
                if (window.innerWidth < 576 && $('#sidebar').hasClass('active')) {
                    if (!$(e.target).closest('#sidebar').length && !$(e.target).closest('#sidebarCollapse').length) {
                        $('#sidebar').removeClass('active');
                        $('#content').removeClass('active');
                        $('body').css('overflow', '');
                    }
                }
            });
            
            // Dark mode toggle
            $('#darkModeToggle').click(function() {
                const currentTheme = $('html').attr('data-theme');
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                
                // Update icon
                $(this).find('i').removeClass('fa-moon fa-sun').addClass(newTheme === 'dark' ? 'fa-sun' : 'fa-moon');
                
                // Update theme
                $('html').attr('data-theme', newTheme);
                
                // Save preference via AJAX
                $.post('{{ route('admin.toggle.dark.mode') }}', {
                    mode: newTheme
                });
            });
            
            // Initialize tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
    
    @yield('scripts')
</body>
</html> 