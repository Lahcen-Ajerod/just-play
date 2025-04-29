<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Game;
use App\Models\Status;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);
        
        // Create statuses
        $statuses = [
            ['name' => 'Active'],
            ['name' => 'Inactive'],
            ['name' => 'Featured'],
        ];
        
        foreach ($statuses as $status) {
            Status::create($status);
        }
        
        // Create categories
        $categories = [
            ['name' => 'Action', 'image' => 'categories/action.jpg'],
            ['name' => 'Adventure', 'image' => 'categories/adventure.jpg'],
            ['name' => 'Racing', 'image' => 'categories/racing.jpg'],
            ['name' => 'Strategy', 'image' => 'categories/strategy.jpg'],
            ['name' => 'Sports', 'image' => 'categories/sports.jpg'],
            ['name' => 'Puzzle', 'image' => 'categories/puzzle.jpg'],
        ];
        
        foreach ($categories as $category) {
            Category::create($category);
        }
        
        // Create games
        $games = [
            [
                'name' => 'Adventure Quest',
                'description' => 'An epic adventure game with amazing quests and challenges.',
                'image' => 'games/adventure-quest.jpg',
                'stars' => 4,
                'play_times' => 1250,
                'operating_system' => 'Windows, macOS',
                'download_link' => 'https://example.com/download/adventure-quest',
                'category_id' => 2, // Adventure
                'status_id' => 3, // Featured
            ],
            [
                'name' => 'Speed Racer',
                'description' => 'Experience high-speed racing on various tracks around the world.',
                'image' => 'games/speed-racer.jpg',
                'stars' => 5,
                'play_times' => 2340,
                'operating_system' => 'Windows, macOS, Linux',
                'download_link' => 'https://example.com/download/speed-racer',
                'category_id' => 3, // Racing
                'status_id' => 3, // Featured
            ],
            [
                'name' => 'Battle Arena',
                'description' => 'Engage in epic battles with players from around the world.',
                'image' => 'games/battle-arena.jpg',
                'stars' => 4,
                'play_times' => 1890,
                'operating_system' => 'Windows',
                'download_link' => 'https://example.com/download/battle-arena',
                'category_id' => 1, // Action
                'status_id' => 1, // Active
            ],
            [
                'name' => 'Strategy Master',
                'description' => 'Plan your strategy and dominate the world in this strategic game.',
                'image' => 'games/strategy-master.jpg',
                'stars' => 3,
                'play_times' => 980,
                'operating_system' => 'Windows, macOS',
                'download_link' => 'https://example.com/download/strategy-master',
                'category_id' => 4, // Strategy
                'status_id' => 1, // Active
            ],
            [
                'name' => 'Football Star',
                'description' => 'Become a football legend and lead your team to victory.',
                'image' => 'games/football-star.jpg',
                'stars' => 4,
                'play_times' => 1560,
                'operating_system' => 'Windows, macOS, Linux',
                'download_link' => 'https://example.com/download/football-star',
                'category_id' => 5, // Sports
                'status_id' => 1, // Active
            ],
            [
                'name' => 'Puzzle Challenge',
                'description' => 'Test your brain with challenging puzzles and riddles.',
                'image' => 'games/puzzle-challenge.jpg',
                'stars' => 5,
                'play_times' => 2100,
                'operating_system' => 'Windows, macOS, Linux, Android, iOS',
                'download_link' => 'https://example.com/download/puzzle-challenge',
                'category_id' => 6, // Puzzle
                'status_id' => 3, // Featured
            ],
            [
                'name' => 'Ninja Warrior',
                'description' => 'Master the art of stealth and become the ultimate ninja warrior.',
                'image' => 'games/ninja-warrior.jpg',
                'stars' => 4,
                'play_times' => 1750,
                'operating_system' => 'Windows, Android, iOS',
                'download_link' => 'https://example.com/download/ninja-warrior',
                'category_id' => 1, // Action
                'status_id' => 1, // Active
            ],
            [
                'name' => 'Mystery Island',
                'description' => 'Explore a mysterious island full of secrets and treasures.',
                'image' => 'games/mystery-island.jpg',
                'stars' => 3,
                'play_times' => 890,
                'operating_system' => 'Windows, macOS',
                'download_link' => 'https://example.com/download/mystery-island',
                'category_id' => 2, // Adventure
                'status_id' => 1, // Active
            ],
        ];
        
        foreach ($games as $game) {
            Game::create($game);
        }
    }
}
