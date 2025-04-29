<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Game;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Game::with(['category', 'status']);
        
        // Filter by category if provided
        if ($request->has('category_id') && $request->category_id !== 'all') {
            $query->where('category_id', $request->category_id);
        }
        
        // Filter by search term if provided
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('operating_system', 'like', "%{$search}%");
            });
        }
        
        // Sort by popularity if requested
        if ($request->has('sort') && $request->sort === 'popular') {
            $query->orderBy('play_times', 'desc');
        } else {
            $query->latest();
        }
        
        $games = $query->get();
        
        return response()->json(['games' => $games]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video' => 'nullable|mimes:mp4,mov,ogg,qt|max:20480',
            'operating_system' => 'required|string|max:255',
            'download_link' => 'required|url',
            'category_id' => 'required|exists:categories,id',
            'status_id' => 'required|exists:statuses,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->only([
            'name', 'description', 'operating_system', 'download_link', 
            'category_id', 'status_id'
        ]);
        
        // Handle image upload
        $data['image'] = $request->file('image')->store('games', 'public');
        
        // Handle video upload if provided
        if ($request->hasFile('video')) {
            $data['video'] = $request->file('video')->store('games/videos', 'public');
        }
        
        // Set default values
        $data['stars'] = 0;
        $data['play_times'] = 0;
        
        $game = Game::create($data);

        return response()->json([
            'message' => 'Game created successfully',
            'game' => $game->load(['category', 'status'])
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $game = Game::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video' => 'nullable|mimes:mp4,mov,ogg,qt|max:20480',
            'operating_system' => 'required|string|max:255',
            'download_link' => 'required|url',
            'category_id' => 'required|exists:categories,id',
            'status_id' => 'required|exists:statuses,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->only([
            'name', 'description', 'operating_system', 'download_link', 
            'category_id', 'status_id'
        ]);
        
        // Handle image upload if provided
        if ($request->hasFile('image')) {
            // Delete old image
            if ($game->image) {
                Storage::disk('public')->delete($game->image);
            }
            $data['image'] = $request->file('image')->store('games', 'public');
        }
        
        // Handle video upload if provided
        if ($request->hasFile('video')) {
            // Delete old video
            if ($game->video) {
                Storage::disk('public')->delete($game->video);
            }
            $data['video'] = $request->file('video')->store('games/videos', 'public');
        }
        
        $game->update($data);

        return response()->json([
            'message' => 'Game updated successfully',
            'game' => $game->load(['category', 'status'])
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $game = Game::findOrFail($id);
        
        // Delete image and video
        if ($game->image) {
            Storage::disk('public')->delete($game->image);
        }
        
        if ($game->video) {
            Storage::disk('public')->delete($game->video);
        }
        
        $game->delete();

        return response()->json([
            'message' => 'Game deleted successfully'
        ]);
    }
    
    /**
     * Increment play times counter
     */
    public function incrementPlayTimes(string $id)
    {
        $game = Game::findOrFail($id);
        $game->increment('play_times');
        
        return response()->json([
            'message' => 'Play times incremented',
            'play_times' => $game->play_times
        ]);
    }
}
