@extends('layouts.frontend')

@section('title', 'Home')

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Poppins', sans-serif;
    }
    
    /* Categories Sidebar */
    .categories-sidebar {
        background-color: var(--card-bg);
        border-radius: 15px;
        box-shadow: 0 5px 15px var(--shadow);
        height: 100%;
        padding: 0;
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
    
    .categories-sidebar .category-name {
        font-weight: 500;
    }
    
    .categories-sidebar .badge {
        background-color: var(--primary-color);
        font-weight: 400;
    }
    
    /* Games Scroll Row */
    .games-row {
        position: relative;
        margin-bottom: 30px;
    }
    
    .games-row-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid var(--primary-color);
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
    
    /* Game Cards */
    .game-card {
        background-color: var(--card-bg);
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px var(--shadow);
        border: none;
        min-width: 220px;
        max-width: 220px;
    }
    
    .game-card .badge-featured {
        position: absolute;
        top: 15px;
        right: 15px;
        background: linear-gradient(90deg, #ff7e5f, #feb47b);
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.8rem;
        z-index: 10;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    }
    
    .game-card .game-image {
        position: relative;
        height: 150px;
        overflow: hidden;
    }
    
    .game-card img, .game-card video {
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
    
    /* Responsive Fixes */
    @media (max-width: 991.98px) {
        .categories-sidebar {
            margin-bottom: 30px;
        }
    }
    
    @media (max-width: 767.98px) {
        .section-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .view-all {
            margin-top: 10px;
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
                <h5 class="mb-0">Game Categories</h5>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item active" data-category="all">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="category-name">All Games</span>
                        <span class="badge rounded-pill">{{ count($featuredGames) + count($trendingGames) }}</span>
                    </div>
                </li>
                @foreach($categories as $category)
                <li class="list-group-item" data-category="{{ $category->id }}">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="category-name">{{ $category->name }}</span>
                        <span class="badge rounded-pill">{{ $category->games_count }}</span>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    
    <!-- Games Content -->
    <div class="col-lg-9">
        <!-- Featured Games Row -->
        <div class="games-row">
            <h2 class="games-row-title">Featured Games</h2>
            <div class="position-relative">
                <button class="scroll-btn prev"><i class="fas fa-chevron-left"></i></button>
                <div class="games-scroll" id="featuredGamesScroll">
                    @foreach($featuredGames as $game)
                    <div class="game-card">
                        @if($game->status_id == 3)
                        <span class="badge-featured">
                            <i class="fas fa-star me-1"></i> Featured
                        </span>
                        @endif
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
        
        <!-- Trending Games Row -->
        <div class="games-row">
            <h2 class="games-row-title">Trending Games</h2>
            <div class="position-relative">
                <button class="scroll-btn prev"><i class="fas fa-chevron-left"></i></button>
                <div class="games-scroll" id="trendingGamesScroll">
                    @foreach($trendingGames as $game)
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
        
        <!-- Latest Games Row -->
        <div class="games-row">
            <h2 class="games-row-title">Latest Games</h2>
            <div class="position-relative">
                <button class="scroll-btn prev"><i class="fas fa-chevron-left"></i></button>
                <div class="games-scroll" id="latestGamesScroll">
                    @foreach($featuredGames->merge($trendingGames)->sortByDesc('created_at')->take(10) as $game)
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
        
        // Category filter functionality
        $('.categories-sidebar .list-group-item').click(function() {
            $('.categories-sidebar .list-group-item').removeClass('active');
            $(this).addClass('active');
            
            const categoryId = $(this).data('category');
            
            if (categoryId === 'all') {
                $('.game-card').show();
            } else {
                $('.game-card').each(function() {
                    const gameCategory = $(this).find('.game-meta span:first-child').text().trim();
                    const selectedCategory = $('.categories-sidebar .list-group-item.active .category-name').text().trim();
                    
                    if (gameCategory.includes(selectedCategory)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }
        });
    });
</script>
@endsection 