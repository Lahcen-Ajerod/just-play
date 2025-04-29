@extends('layouts.frontend')

@section('title', 'Games')

@section('styles')
<style>
    /* Category Sidebar */
    .categories-sidebar {
        background-color: var(--card-bg);
        border-radius: 15px;
        box-shadow: 0 5px 15px var(--shadow);
        height: 100%;
        overflow: hidden;
    }
    
    .categories-sidebar .card-header {
        background-color: var(--primary-color);
        color: white;
        font-weight: 600;
        padding: 15px 20px;
        border: none;
    }
    
    .categories-sidebar .list-group-item {
        background-color: var(--card-bg);
        color: var(--text-color);
        border-color: var(--shadow);
        transition: all 0.3s;
        cursor: pointer;
        padding: 15px 20px;
    }
    
    .categories-sidebar .list-group-item:hover,
    .categories-sidebar .list-group-item.active {
        background-color: rgba(var(--primary-color-rgb), 0.1);
        color: var(--primary-color);
        border-left: 4px solid var(--primary-color);
    }
    
    /* Game Cards Grid */
    .games-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 20px;
    }
    
    .game-card {
        background-color: var(--card-bg);
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px var(--shadow);
        border: none;
        height: 100%;
    }
    
    .game-card .game-image {
        position: relative;
        height: 150px;
        overflow: hidden;
    }
    
    .game-card img,
    .game-card video {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
    }
    
    .game-card:hover img,
    .game-card:hover video {
        transform: scale(1.1);
    }
    
    .game-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px var(--shadow);
    }
    
    .game-card .card-body {
        padding: 15px;
    }
    
    .game-card .card-title {
        font-weight: 700;
        margin-bottom: 10px;
        font-size: 1.1rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .game-card .stars {
        color: #f1c40f;
        margin-bottom: 10px;
        font-size: 0.9rem;
    }
    
    .game-card .game-meta {
        font-size: 0.75rem;
        color: var(--text-color);
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }
    
    .game-card .btn {
        width: 100%;
        padding: 8px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.3s;
    }
    
    .game-card .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    /* Sort and Filter Bar */
    .filter-bar {
        background-color: var(--card-bg);
        border-radius: 15px;
        padding: 15px 20px;
        margin-bottom: 20px;
        box-shadow: 0 5px 15px var(--shadow);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
    }
    
    .filter-bar .form-select {
        background-color: rgba(var(--primary-color-rgb), 0.1);
        border: none;
        color: var(--text-color);
        border-radius: 50px;
        padding: 8px 15px;
        font-size: 0.9rem;
        max-width: 200px;
        cursor: pointer;
    }
    
    .filter-bar .title {
        font-weight: 600;
        margin-bottom: 0;
        font-size: 1.2rem;
    }
    
    .results-count {
        color: var(--primary-color);
        font-weight: 500;
    }
    
    /* Category Row */
    .category-section {
        margin-bottom: 30px;
    }
    
    .category-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid var(--primary-color);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .games-scroll {
        display: flex;
        overflow-x: auto;
        gap: 15px;
        padding: 10px 0;
        scrollbar-width: thin;
        position: relative;
    }
    
    .games-scroll::-webkit-scrollbar {
        height: 8px;
    }
    
    .games-scroll::-webkit-scrollbar-track {
        background: var(--background-color);
        border-radius: 10px;
    }
    
    .games-scroll::-webkit-scrollbar-thumb {
        background: var(--primary-color);
        border-radius: 10px;
    }
    
    .games-scroll .game-card {
        min-width: 220px;
        max-width: 220px;
        margin-bottom: 0;
    }
    
    .scroll-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background-color: var(--primary-color);
        color: white;
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 3px 10px var(--shadow);
        z-index: 10;
        cursor: pointer;
        opacity: 0.8;
        transition: all 0.3s;
    }
    
    .scroll-btn:hover {
        opacity: 1;
    }
    
    .scroll-btn.prev {
        left: -15px;
    }
    
    .scroll-btn.next {
        right: -15px;
    }
    
    /* No Games Message */
    .no-games {
        padding: 50px 20px;
        text-align: center;
        background-color: var(--card-bg);
        border-radius: 15px;
        box-shadow: 0 5px 15px var(--shadow);
    }
    
    .no-games i {
        font-size: 3rem;
        color: var(--primary-color);
        margin-bottom: 20px;
        opacity: 0.5;
    }
    
    /* Responsive */
    @media (max-width: 991.98px) {
        .categories-sidebar {
            margin-bottom: 30px;
        }
    }
</style>
@endsection

@section('content')
<div class="row">
    <!-- Categories Sidebar -->
    <div class="col-lg-3 mb-4">
        <div class="categories-sidebar">
            <div class="card-header">
                <h5 class="mb-0">Categories</h5>
            </div>
            <ul class="list-group list-group-flush" id="categoriesList">
                <li class="list-group-item active" data-id="all">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="category-name">All Categories</span>
                        <span class="badge rounded-pill">{{ $games->count() }}</span>
                    </div>
                </li>
                @foreach($categories as $category)
                <li class="list-group-item" data-id="{{ $category->id }}">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="category-name">{{ $category->name }}</span>
                        <span class="badge rounded-pill">{{ $category->games_count }}</span>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    
    <!-- Games Container -->
    <div class="col-lg-9">
        <!-- Filter Bar -->
        <div class="filter-bar">
            <div>
                <h2 class="title">Games</h2>
                <p class="results-count mb-0" id="resultsCount">Showing {{ $games->count() }} games</p>
            </div>
            
            <div class="d-flex align-items-center">
                <select class="form-select me-2" id="sortGames">
                    <option value="popular" selected>Most Popular</option>
                    <option value="newest">Newest</option>
                    <option value="highest">Highest Rated</option>
                </select>
            </div>
        </div>
        
        <!-- Games Display -->
        <div id="gamesDisplay">
            @if($categories->count() > 0)
                @foreach($categories as $category)
                    @php
                        $categoryGames = $games->where('category_id', $category->id);
                    @endphp
                    
                    @if($categoryGames->count() > 0)
                    <div class="category-section" data-category="{{ $category->id }}">
                        <h3 class="category-title">
                            {{ $category->name }}
                            <span class="badge bg-primary rounded-pill">{{ $categoryGames->count() }}</span>
                        </h3>
                        
                        <div class="position-relative">
                            <button class="scroll-btn prev"><i class="fas fa-chevron-left"></i></button>
                            <div class="games-scroll">
                                @foreach($categoryGames as $game)
                                <div class="game-card">
                                    <div class="game-image">
                                        <img src="{{ asset('storage/' . $game->image) }}" alt="{{ $game->name }}" class="game-thumbnail">
                                        @if($game->video)
                                        <video src="{{ asset('storage/' . $game->video) }}" muted loop class="game-video d-none"></video>
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $game->name }}</h5>
                                        <div class="stars">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $game->stars)
                                                    <i class="fas fa-star"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        <div class="game-meta">
                                            <span><i class="fas fa-folder me-1"></i> {{ $game->category->name }}</span>
                                            <span><i class="fas fa-gamepad me-1"></i> {{ $game->play_times }}</span>
                                        </div>
                                        <a href="{{ route('game.show', $game->id) }}" class="btn btn-primary">View Details</a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <button class="scroll-btn next"><i class="fas fa-chevron-right"></i></button>
                        </div>
                    </div>
                    @endif
                @endforeach
            @else
                <div class="no-games">
                    <i class="fas fa-gamepad"></i>
                    <h3>No games available</h3>
                    <p>We're working on adding more games. Please check back soon!</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Video preview on hover
        $('.game-card').hover(
            function() {
                const video = $(this).find('video');
                const image = $(this).find('img.game-thumbnail');
                
                if (video.length) {
                    image.addClass('d-none');
                    video.removeClass('d-none');
                    video[0].play();
                }
            },
            function() {
                const video = $(this).find('video');
                const image = $(this).find('img.game-thumbnail');
                
                if (video.length) {
                    video.addClass('d-none');
                    image.removeClass('d-none');
                    video[0].pause();
                }
            }
        );
        
        // Category filter
        $('.category-link').click(function(e) {
            e.preventDefault();
            
            // Update active class
            $('.category-link').removeClass('active');
            $(this).addClass('active');
            
            const categoryId = $(this).data('id');
            
            if (categoryId === 'all') {
                $('.category-section').show();
            } else {
                $('.category-section').hide();
                $(`.category-section[data-category="${categoryId}"]`).show();
            }
            
            updateResultsCount();
        });
        
        // Sidebar category filter
        $('#categoriesList .list-group-item').click(function() {
            // Update active class
            $('#categoriesList .list-group-item').removeClass('active');
            $(this).addClass('active');
            
            const categoryId = $(this).data('id');
            
            if (categoryId === 'all') {
                $('.category-section').show();
            } else {
                $('.category-section').hide();
                $(`.category-section[data-category="${categoryId}"]`).show();
            }
            
            updateResultsCount();
        });
        
        // Sort games
        $('#sortGames').change(function() {
            const sortOption = $(this).val();
            sortGames(sortOption);
        });
        
        // Update results count
        function updateResultsCount() {
            const visibleSections = $('.category-section:visible');
            let totalGames = 0;
            
            visibleSections.each(function() {
                const gamesCount = $(this).find('.game-card').length;
                totalGames += gamesCount;
            });
            
            $('#resultsCount').text(`Showing ${totalGames} games`);
        }
        
        // Sort games function
        function sortGames(sortOption) {
            $('.category-section').each(function() {
                const gameCards = $(this).find('.game-card').toArray();
                
                gameCards.sort(function(a, b) {
                    if (sortOption === 'popular') {
                        const aPlays = parseInt($(a).find('.game-meta span:last-child').text().match(/\d+/)[0]);
                        const bPlays = parseInt($(b).find('.game-meta span:last-child').text().match(/\d+/)[0]);
                        return bPlays - aPlays;
                    } else if (sortOption === 'highest') {
                        const aStars = $(a).find('.fa-star').length;
                        const bStars = $(b).find('.fa-star').length;
                        return bStars - aStars;
                    }
                    // Default: newest (assuming newer games are already first in the DOM)
                    return 0;
                });
                
                const container = $(this).find('.games-scroll');
                container.empty();
                
                $.each(gameCards, function(idx, card) {
                    container.append(card);
                });
            });
        }
        
        // Scroll buttons functionality
        $('.scroll-btn.next').click(function() {
            const scrollContainer = $(this).closest('.position-relative').find('.games-scroll');
            scrollContainer.animate({
                scrollLeft: scrollContainer.scrollLeft() + 300
            }, 300);
        });
        
        $('.scroll-btn.prev').click(function() {
            const scrollContainer = $(this).closest('.position-relative').find('.games-scroll');
            scrollContainer.animate({
                scrollLeft: scrollContainer.scrollLeft() - 300
            }, 300);
        });
    });
</script>
@endsection 