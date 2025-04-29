<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\GameController as AdminGameController;
use App\Http\Controllers\Frontend\GameController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\UserAuthController;
use App\Http\Middleware\AdminAuth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::post('/toggle-theme', [HomeController::class, 'toggleDarkMode'])->name('toggle.theme');

// User Authentication Routes
Route::get('/login', [UserAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserAuthController::class, 'login'])->name('login.submit');
Route::get('/register', [UserAuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [UserAuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [UserAuthController::class, 'logout'])->name('logout');

// Games Routes
Route::get('/games', [GameController::class, 'index'])->name('games');
Route::get('/games/category/{id}', [GameController::class, 'byCategory'])->name('games.by.category');
Route::get('/game/{id}', [GameController::class, 'show'])->name('game.show');
Route::get('/game/{id}/play', [GameController::class, 'play'])->name('game.play');
Route::post('/game/{id}/rate', [GameController::class, 'rate'])->name('game.rate');

// Admin Auth Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Public routes
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/toggle-dark-mode', [AdminController::class, 'toggleDarkMode'])->name('toggle.dark.mode');
    
    // Protected routes
    Route::middleware(AdminAuth::class)->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
        Route::get('/categories/data', [AdminController::class, 'getCategories'])->name('categories.data');
        Route::get('/statuses/data', [AdminController::class, 'getStatuses'])->name('statuses.data');
        Route::get('/games/data', [AdminGameController::class, 'index'])->name('games.data');
        
        // AJAX Routes for Categories
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
        
        // AJAX Routes for Games
        Route::get('/games', [AdminGameController::class, 'index'])->name('games.index');
        Route::post('/games', [AdminGameController::class, 'store'])->name('games.store');
        Route::put('/games/{id}', [AdminGameController::class, 'update'])->name('games.update');
        Route::delete('/games/{id}', [AdminGameController::class, 'destroy'])->name('games.destroy');
        Route::post('/games/{id}/play', [AdminGameController::class, 'incrementPlayTimes'])->name('games.play');
    });
});
