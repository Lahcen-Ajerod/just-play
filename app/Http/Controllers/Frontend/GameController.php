<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display games page with all categories
     */
    public function index()
    {
        $categories = Category::withCount('games')->get();
        $games = Game::with('category')->orderBy('play_times', 'desc')->take(12)->get();
        
        return view('frontend.games', compact('categories', 'games'));
    }
    
    /**
     * Show games by category
     */
    public function byCategory($id)
    {
        $category = Category::findOrFail($id);
        $games = $category->games()->with('category')->get();
        
        return response()->json(['games' => $games]);
    }
    
    /**
     * Show game details
     */
    public function show($id)
    {
        $game = Game::with(['category', 'status'])->findOrFail($id);
        $relatedGames = Game::where('category_id', $game->category_id)
                          ->where('id', '!=', $game->id)
                          ->take(4)
                          ->get();
        
        return view('frontend.game-details', compact('game', 'relatedGames'));
    }
    
    /**
     * Record game play
     */
    public function play($id)
    {
        $game = Game::findOrFail($id);
        $game->increment('play_times');
        
        return redirect()->to($game->download_link);
    }
    
    /**
     * Rate a game
     */
    public function rate(Request $request, $id)
    {
        $game = Game::findOrFail($id);
        $stars = $request->input('stars', 5);
        
        // Simple implementation for rating (in a real app, would track user ratings)
        $game->stars = $stars;
        $game->save();
        
        return response()->json([
            'message' => 'Game rated successfully',
            'stars' => $game->stars
        ]);
    }
}
