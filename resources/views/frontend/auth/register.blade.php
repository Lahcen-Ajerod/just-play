@extends('layouts.frontend')

@section('title', 'Register')

@section('styles')
<style>
    .auth-container {
        max-width: 500px;
        margin: 50px auto;
    }
    
    .auth-card {
        background-color: var(--card-bg);
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 15px var(--shadow);
        border: none;
    }
    
    .auth-card .card-header {
        background-color: var(--primary-color);
        color: white;
        font-weight: 600;
        padding: 20px;
        text-align: center;
        border: none;
    }
    
    .auth-card .card-body {
        padding: 30px;
    }
    
    .auth-title {
        margin-bottom: 30px;
        text-align: center;
        font-weight: 700;
        color: var(--text-color);
    }
    
    .auth-form .form-control {
        background-color: var(--background-color);
        border: 1px solid var(--shadow);
        color: var(--text-color);
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 20px;
    }
    
    .auth-form .form-control:focus {
        box-shadow: 0 0 0 3px rgba(var(--primary-color-rgb), 0.2);
        border-color: var(--primary-color);
    }
    
    .auth-form .btn-submit {
        width: 100%;
        padding: 12px;
        border-radius: 8px;
        font-weight: 600;
        margin-top: 10px;
    }
    
    .auth-footer {
        text-align: center;
        margin-top: 20px;
        font-size: 0.9rem;
    }
    
    .auth-footer a {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 600;
    }
    
    .auth-footer a:hover {
        text-decoration: underline;
    }
</style>
@endsection

@section('content')
<div class="auth-container">
    <div class="auth-card card">
        <div class="card-header">
            <h3 class="mb-0">Join AyoubGames</h3>
        </div>
        <div class="card-body">
            <h4 class="auth-title">Create Your Account</h4>
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form method="POST" action="{{ route('register.submit') }}" class="auth-form">
                @csrf
                
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required autofocus>
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                </div>
                
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                </div>
                
                <button type="submit" class="btn btn-primary btn-submit">
                    <i class="fas fa-user-plus me-2"></i> Register
                </button>
            </form>
            
            <div class="auth-footer">
                <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
            </div>
        </div>
    </div>
</div>
@endsection 