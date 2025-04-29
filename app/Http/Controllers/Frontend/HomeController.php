<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Game;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show home page with trending games
     */
    public function index()
    {
        $trendingGames = Game::orderBy('play_times', 'desc')->take(8)->get();
        $featuredGames = Game::where('status_id', 3)->take(4)->get();
        $categories = Category::withCount('games')->take(6)->get();
        
        return view('frontend.home', compact('trendingGames', 'featuredGames', 'categories'));
    }
    
    /**
     * Search games by name
     */
    public function search(Request $request)
    {
        $search = $request->input('query');
        
        $games = Game::where('name', 'like', "%{$search}%")
                     ->orWhere('description', 'like', "%{$search}%")
                     ->get();
                     
        return response()->json(['games' => $games]);
    }
    
    /**
     * Toggle dark mode
     */
    public function toggleDarkMode(Request $request)
    {
        $theme = $request->input('theme', 'light');
        
        // Store in session
        session(['dark_mode' => $theme]);
        
        return response()->json(['theme' => $theme]);
    }
}
