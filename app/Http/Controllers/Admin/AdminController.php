<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Game;
use App\Models\Status;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function dashboard()
    {
        $categoriesCount = Category::count();
        $gamesCount = Game::count();
        $statuses = Status::all();
        
        return view('admin.dashboard', compact('categoriesCount', 'gamesCount', 'statuses'));
    }
    
    /**
     * Get categories for admin panel
     */
    public function getCategories()
    {
        $categories = Category::withCount('games')->get();
        return response()->json(['categories' => $categories]);
    }
    
    /**
     * Get statuses for admin panel
     */
    public function getStatuses()
    {
        $statuses = Status::all();
        return response()->json(['statuses' => $statuses]);
    }
    
    /**
     * Show user profile for edit
     */
    public function profile()
    {
        return view('admin.profile');
    }

    /**
     * Toggle dark mode
     */
    public function toggleDarkMode(Request $request)
    {
        $mode = $request->input('mode', 'light');
        
        // Store in session
        session(['dark_mode' => $mode]);
        
        return response()->json(['mode' => $mode]);
    }
}
