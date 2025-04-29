@extends('layouts.frontend')

@section('title', $game->name)

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-body">
                <div class="game-header d-flex justify-content-between align-items-center mb-4">
                    <h1 class="mb-0">{{ $game->name }}</h1>
                    <div class="stars">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $game->stars)
                                <i class="fas fa-star"></i>
                            @else
                                <i class="far fa-star"></i>
                            @endif
                        @endfor
                    </div>
                </div>
                
                <div class="game-image mb-4">
                    @if($game->video)
                        <video src="{{ asset('storage/' . $game->video) }}" controls class="w-100 rounded" style="max-height: 400px; object-fit: cover;"></video>
                    @else
                        <img src="{{ asset('storage/' . $game->image) }}" alt="{{ $game->name }}" class="w-100 rounded" style="max-height: 400px; object-fit: cover;">
                    @endif
                </div>
                
                <div class="game-details mb-4">
                    <h4>Description</h4>
                    <p>{{ $game->description }}</p>
                </div>
                
                <div class="game-meta">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Game Information</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2"><strong>Category:</strong> {{ $game->category->name }}</li>
                                <li class="mb-2"><strong>Operating System:</strong> {{ $game->operating_system }}</li>
                                <li class="mb-2"><strong>Play Times:</strong> {{ $game->play_times }}</li>
                                <li class="mb-2"><strong>Status:</strong> {{ $game->status->name }}</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h5>Rate This Game</h5>
                            <div class="rating-stars mb-3">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="far fa-star rating-star" data-rating="{{ $i }}"></i>
                                @endfor
                            </div>
                            <a href="{{ route('game.play', $game->id) }}" class="btn btn-primary">
                                <i class="fas fa-download me-2"></i> Download & Play
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Related Games</h5>
            </div>
            <div class="card-body">
                @forelse($relatedGames as $relatedGame)
                    <div class="related-game mb-3">
                        <div class="row g-0">
                            <div class="col-4">
                                <img src="{{ asset('storage/' . $relatedGame->image) }}" alt="{{ $relatedGame->name }}" class="img-fluid rounded">
                            </div>
                            <div class="col-8 ps-3">
                                <h6>{{ $relatedGame->name }}</h6>
                                <div class="stars small">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $relatedGame->stars)
                                            <i class="fas fa-star"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                </div>
                                <a href="{{ route('game.show', $relatedGame->id) }}" class="btn btn-sm btn-outline-primary mt-2">View</a>
                            </div>
                        </div>
                    </div>
                    @if(!$loop->last)
                        <hr>
                    @endif
                @empty
                    <p>No related games found.</p>
                @endforelse
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">More from {{ $game->category->name }}</h5>
            </div>
            <div class="card-body">
                <a href="{{ route('games') }}?category={{ $game->category_id }}" class="btn btn-outline-primary w-100">
                    View All {{ $game->category->name }} Games
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Rating functionality
        $('.rating-star').hover(
            function() {
                const rating = $(this).data('rating');
                
                // Reset all stars
                $('.rating-star').removeClass('fas').addClass('far');
                
                // Fill stars up to current
                $('.rating-star').each(function() {
                    if ($(this).data('rating') <= rating) {
                        $(this).removeClass('far').addClass('fas');
                    }
                });
            },
            function() {
                // On hover out reset stars
                $('.rating-star').removeClass('fas').addClass('far');
            }
        );
        
        // Handle star click for rating
        $('.rating-star').click(function() {
            const rating = $(this).data('rating');
            
            // Send rating via AJAX
            $.post('{{ route('game.rate', $game->id) }}', {
                stars: rating
            }, function(response) {
                // Update display
                $('.rating-star').removeClass('fas').addClass('far');
                
                for (let i = 1; i <= response.stars; i++) {
                    $(`.rating-star[data-rating="${i}"]`).removeClass('far').addClass('fas');
                }
                
                // Show success message
                alert('Game rated successfully!');
            });
        });
    });
</script>
@endsection 