@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <p class="text-muted">Welcome to Ayoub Games Admin Panel</p>
        </div>
    </div>

    <!-- Dashboard Stats -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-0 stat-card h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon me-3">
                        <i class="fas fa-folder fa-2x"></i>
                    </div>
                    <div>
                        <h6 class="stat-label">Total Categories</h6>
                        <h2 class="stat-number">{{ $categoriesCount }}</h2>
                        <div class="progress">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: {{ min($categoriesCount * 10, 100) }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-0 stat-card h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon me-3" style="background-color: rgba(46, 204, 113, 0.1); color: var(--success-color);">
                        <i class="fas fa-gamepad fa-2x"></i>
                    </div>
                    <div>
                        <h6 class="stat-label">Total Games</h6>
                        <h2 class="stat-number">{{ $gamesCount }}</h2>
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ min($gamesCount * 5, 100) }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-0 stat-card h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon me-3" style="background-color: rgba(243, 156, 18, 0.1); color: var(--warning-color);">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                    <div>
                        <h6 class="stat-label">Active Users</h6>
                        <h2 class="stat-number">1</h2>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-0 stat-card h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon me-3" style="background-color: rgba(52, 152, 219, 0.1); color: var(--info-color);">
                        <i class="fas fa-download fa-2x"></i>
                    </div>
                    <div>
                        <h6 class="stat-label">Total Downloads</h6>
                        <h2 class="stat-number">{{ array_sum(DB::table('games')->pluck('play_times')->toArray()) }}</h2>
                        <div class="progress">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 75%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Categories Section -->
    <div class="card mb-4" id="categories" style="border: 1px solid var(--border-color); border-radius: 8px; box-shadow: var(--card-shadow);">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Categories Management</h5>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
                <i class="fas fa-plus me-2"></i> Add Category
            </button>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text bg-light border-0">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input type="text" class="form-control bg-light border-0" id="searchCategory" placeholder="Search categories...">
                </div>
            </div>
            
            <div class="row" id="categoriesContainer">
                <!-- Categories will be loaded here via AJAX -->
            </div>
        </div>
    </div>
    
    <!-- Games Section -->
    <div class="card" id="games" style="border: 1px solid var(--border-color); border-radius: 8px; box-shadow: var(--card-shadow);">
        <div class="card-header d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0 fw-bold"><i class="fas fa-gamepad me-2 text-primary"></i>Games Management</h5>
            <button class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#createGameModal">
                <i class="fas fa-plus me-2"></i> Add Game
            </button>
        </div>
        <div class="card-body p-4">
            <div class="mb-4 row g-3">
                <div class="col-lg-8">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control bg-light border-0" id="searchGame" placeholder="Search games by name, category or status...">
                    </div>
                </div>
                <div class="col-lg-4">
                    <select class="form-select border-0 bg-light" id="filterCategory">
                        <option value="all">All Categories</option>
                        <!-- Categories will be loaded here via AJAX -->
                    </select>
                </div>
            </div>
            
            <div class="table-responsive rounded d-none" id="gamesTable">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th scope="col" width="60">#</th>
                            <th scope="col">Game</th>
                            <th scope="col">Category</th>
                            <th scope="col">Status</th>
                            <th scope="col">Downloads</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="gamesTableBody">
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <div class="spinner-border text-primary" role="status"></div>
                                <p class="mt-2">Loading games...</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <!-- Pagination Controls -->
                <div class="d-flex justify-content-between align-items-center mt-3 pagination-container">
                    <div class="d-flex align-items-center">
                        <label class="me-2 text-nowrap">Show</label>
                        <select class="form-select form-select-sm me-2" id="rowsPerPage">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="500">500</option>
                        </select>
                        <span>entries</span>
                    </div>
                    <div id="paginationInfo" class="text-muted">
                        Showing <span id="fromRow">1</span> to <span id="toRow">10</span> of <span id="totalRows">0</span> entries
                    </div>
                    <nav>
                        <ul class="pagination mb-0">
                            <li class="page-item disabled" id="prevPage">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item" id="nextPage">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            
            <div id="gamesGrid">
                <div class="row" id="gamesContainer">
                    <!-- Games will be loaded here via AJAX -->
                </div>
                
                <!-- Grid Pagination Controls -->
                <div class="d-flex justify-content-between align-items-center mt-4 grid-pagination-container">
                    <div>
                        <span id="gridPaginationInfo" class="text-muted">
                            Showing <span id="gridFromRow">1</span> to <span id="gridToRow">12</span> of <span id="gridTotalRows">0</span> games
                        </span>
                    </div>
                    <nav>
                        <ul class="pagination mb-0">
                            <li class="page-item disabled" id="gridPrevPage">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item" id="gridNextPage">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            
            <div class="d-flex justify-content-end mt-3">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-outline-primary btn-sm" id="tableViewBtn">
                        <i class="fas fa-list me-1"></i> Table View
                    </button>
                    <button type="button" class="btn btn-outline-primary btn-sm active" id="gridViewBtn">
                        <i class="fas fa-th-large me-1"></i> Grid View
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create Category Modal -->
<div class="modal fade" id="createCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createCategoryForm" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="categoryName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="categoryName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="categoryImage" class="form-label">Image</label>
                        <input type="file" class="form-control" id="categoryImage" name="image" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="saveCategory">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editCategoryForm" enctype="multipart/form-data">
                    <input type="hidden" id="editCategoryId">
                    <div class="mb-3">
                        <label for="editCategoryName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="editCategoryName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="editCategoryImage" class="form-label">Image</label>
                        <input type="file" class="form-control" id="editCategoryImage" name="image">
                        <small class="form-text text-muted">Leave empty to keep current image</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="updateCategory">Update</button>
            </div>
        </div>
    </div>
</div>

<!-- Create Game Modal -->
<div class="modal fade" id="createGameModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Game</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createGameForm" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="gameName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="gameName" name="name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="gameCategory" class="form-label">Category</label>
                            <select class="form-select" id="gameCategory" name="category_id" required>
                                <!-- Categories will be loaded here via AJAX -->
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="gameDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="gameDescription" name="description" rows="3" required></textarea>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="gameImage" class="form-label">Image</label>
                            <input type="file" class="form-control" id="gameImage" name="image" required>
                        </div>
                        <div class="col-md-6">
                            <label for="gameVideo" class="form-label">Video (Optional)</label>
                            <input type="file" class="form-control" id="gameVideo" name="video">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="gameOS" class="form-label">Operating System</label>
                            <input type="text" class="form-control" id="gameOS" name="operating_system" required>
                        </div>
                        <div class="col-md-6">
                            <label for="gameStatus" class="form-label">Status</label>
                            <select class="form-select" id="gameStatus" name="status_id" required>
                                <!-- Statuses will be loaded here via AJAX -->
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="gameDownloadLink" class="form-label">Download Link</label>
                        <input type="url" class="form-control" id="gameDownloadLink" name="download_link" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="saveGame">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Game Modal -->
<div class="modal fade" id="editGameModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Game</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editGameForm" enctype="multipart/form-data">
                    <input type="hidden" id="editGameId">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="editGameName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="editGameName" name="name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="editGameCategory" class="form-label">Category</label>
                            <select class="form-select" id="editGameCategory" name="category_id" required>
                                <!-- Categories will be loaded here via AJAX -->
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="editGameDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="editGameDescription" name="description" rows="3" required></textarea>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="editGameImage" class="form-label">Image</label>
                            <input type="file" class="form-control" id="editGameImage" name="image">
                            <small class="form-text text-muted">Leave empty to keep current image</small>
                        </div>
                        <div class="col-md-6">
                            <label for="editGameVideo" class="form-label">Video (Optional)</label>
                            <input type="file" class="form-control" id="editGameVideo" name="video">
                            <small class="form-text text-muted">Leave empty to keep current video</small>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="editGameOS" class="form-label">Operating System</label>
                            <input type="text" class="form-control" id="editGameOS" name="operating_system" required>
                        </div>
                        <div class="col-md-6">
                            <label for="editGameStatus" class="form-label">Status</label>
                            <select class="form-select" id="editGameStatus" name="status_id" required>
                                <!-- Statuses will be loaded here via AJAX -->
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="editGameDownloadLink" class="form-label">Download Link</label>
                        <input type="url" class="form-control" id="editGameDownloadLink" name="download_link" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="updateGame">Update</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Load categories and games
        loadCategories();
        loadCategoriesForDropdown();
        loadStatusesForDropdown();
        loadGames();
        
        // Game view toggle
        $('#tableViewBtn').click(function() {
            $(this).addClass('active');
            $('#gridViewBtn').removeClass('active');
            $('#gamesTable').removeClass('d-none');
            $('#gamesGrid').addClass('d-none');
        });
        
        $('#gridViewBtn').click(function() {
            $(this).addClass('active');
            $('#tableViewBtn').removeClass('active');
            $('#gamesTable').addClass('d-none');
            $('#gamesGrid').removeClass('d-none');
        });
        
        // Pagination variables
        let currentPage = 1;
        let rowsPerPage = 10;
        let totalPages = 1;
        let allGames = [];
        
        // Category Functions
        function loadCategories() {
            $.get('{{ route('admin.categories.data') }}', function(data) {
                displayCategories(data.categories);
            });
        }
        
        function displayCategories(categories) {
            let html = '';
            
            if (categories.length === 0) {
                html = '<div class="col-12 text-center py-5"><p class="text-muted"><i class="fas fa-folder-open fa-3x mb-3"></i><br>No categories found. Create one to get started!</p></div>';
            } else {
                categories.forEach(category => {
                    html += `
                    <div class="col-md-4 col-lg-3 mb-4">
                        <div class="category-card h-100" style="border: 1px solid var(--border-color); border-radius: 8px; box-shadow: var(--card-shadow); overflow: hidden;">
                            <div class="position-relative">
                                <img src="/storage/${category.image}" alt="${category.name}" class="img-fluid">
                                <div class="position-absolute top-0 end-0 m-2">
                                    <span class="badge bg-primary rounded-pill">
                                        <i class="fas fa-gamepad me-1"></i> ${category.games_count}
                                    </span>
                                </div>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">${category.name}</h5>
                                <div class="mt-auto pt-3 d-flex gap-2">
                                    <button class="btn btn-sm btn-outline-primary edit-category-btn flex-grow-1" data-id="${category.id}" data-name="${category.name}" data-image="${category.image}" data-bs-toggle="tooltip" title="Edit Category">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger delete-category-btn" data-id="${category.id}" data-bs-toggle="tooltip" title="Delete Category">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>`;
                });
            }
            
            $('#categoriesContainer').html(html);
            
            // Initialize tooltips
            const tooltips = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltips.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
            
            // Attach event listeners to edit and delete buttons
            $('.edit-category-btn').click(function() {
                const categoryId = $(this).data('id');
                const categoryName = $(this).data('name');
                
                $('#editCategoryId').val(categoryId);
                $('#editCategoryName').val(categoryName);
                
                $('#editCategoryModal').modal('show');
            });
            
            $('.delete-category-btn').click(function() {
                const categoryId = $(this).data('id');
                
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This will delete the category and all associated games!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        deleteCategory(categoryId);
                    }
                });
            });
        }
        
        // Game Functions
        function loadGames(categoryId = 'all', searchTerm = '') {
            $('#gamesTableBody').html('<tr><td colspan="6" class="text-center py-4"><div class="spinner-border text-primary" role="status"></div><p class="mt-2">Loading games...</p></td></tr>');
            $('#gamesContainer').html('<div class="col-12 text-center py-5"><div class="spinner-border text-primary" role="status"></div><p class="mt-2">Loading games...</p></div>');
            
            $.get('{{ route('admin.games.data') }}', { 
                category_id: categoryId,
                search: searchTerm
            }, function(data) {
                allGames = data.games;
                totalPages = Math.ceil(allGames.length / rowsPerPage);
                
                displayPaginatedGames(1);
                updatePaginationControls();
            });
        }
        
        function displayPaginatedGames(page) {
            currentPage = page;
            
            // Calculate start and end index for this page
            const startIndex = (page - 1) * rowsPerPage;
            const endIndex = Math.min(startIndex + rowsPerPage, allGames.length);
            
            // Get current page games
            const currentGames = allGames.slice(startIndex, endIndex);
            
            // Update pagination info
            $('#fromRow, #gridFromRow').text(allGames.length ? startIndex + 1 : 0);
            $('#toRow, #gridToRow').text(endIndex);
            $('#totalRows, #gridTotalRows').text(allGames.length);
            
            // Display the games
            displayGames(currentGames, startIndex);
        }
        
        function updatePaginationControls() {
            // Update prev/next buttons state
            $('#prevPage, #gridPrevPage').toggleClass('disabled', currentPage === 1);
            $('#nextPage, #gridNextPage').toggleClass('disabled', currentPage === totalPages || totalPages === 0);
            
            // Event listeners for pagination controls
            $('#prevPage, #gridPrevPage').off('click').on('click', function(e) {
                e.preventDefault();
                if (currentPage > 1) {
                    displayPaginatedGames(currentPage - 1);
                }
            });
            
            $('#nextPage, #gridNextPage').off('click').on('click', function(e) {
                e.preventDefault();
                if (currentPage < totalPages) {
                    displayPaginatedGames(currentPage + 1);
                }
            });
        }
        
        function displayGames(games, startIndex) {
            let tableHtml = '';
            let gridHtml = '';
            
            if (games.length === 0) {
                tableHtml = '<tr><td colspan="6" class="text-center py-5"><p class="text-muted"><i class="fas fa-gamepad fa-3x mb-3"></i><br>No games found. Create one to get started!</p></td></tr>';
                gridHtml = '<div class="col-12 text-center py-5"><p class="text-muted"><i class="fas fa-gamepad fa-3x mb-3"></i><br>No games found. Create one to get started!</p></div>';
            } else {
                games.forEach((game, index) => {
                    // Table row HTML
                    tableHtml += `
                    <tr>
                        <td>${startIndex + index + 1}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="/storage/${game.image}" alt="${game.name}" width="50" height="50" class="rounded me-3" style="object-fit: cover;">
                                <div>
                                    <h6 class="mb-0">${game.name}</h6>
                                    <small class="text-muted">${game.operating_system}</small>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge bg-light text-dark">${game.category.name}</span></td>
                        <td><span class="badge bg-${getStatusColor(game.status.name)}">${game.status.name}</span></td>
                        <td>${game.play_times}</td>
                        <td class="text-end">
                            <div class="action-buttons">
                                <button class="btn btn-sm btn-outline-primary edit-game-btn" data-id="${game.id}" data-bs-toggle="tooltip" title="Edit Game">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger delete-game-btn" data-id="${game.id}" data-bs-toggle="tooltip" title="Delete Game">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>`;
                    
                    // Grid card HTML
                    gridHtml += `
                    <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                        <div class="card h-100 game-card" style="border: 1px solid var(--border-color); border-radius: 8px; box-shadow: var(--card-shadow);">
                            <div class="position-relative">
                                <img src="/storage/${game.image}" class="card-img-top" alt="${game.name}" style="height: 180px; object-fit: cover; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                                <span class="position-absolute top-0 end-0 m-2 badge bg-${getStatusColor(game.status.name)}">${game.status.name}</span>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="card-title mb-0">${game.name}</h5>
                                    <span class="badge bg-light text-dark">${game.category.name}</span>
                                </div>
                                <p class="card-text small text-muted mb-2">${truncateText(game.description, 80)}</p>
                                <div class="d-flex justify-content-between mt-auto pt-2">
                                    <span class="text-muted small"><i class="fas fa-download me-1"></i>${game.play_times} downloads</span>
                                    <div class="action-buttons">
                                        <button class="btn btn-sm btn-outline-primary edit-game-btn" data-id="${game.id}" data-bs-toggle="tooltip" title="Edit Game">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger delete-game-btn" data-id="${game.id}" data-bs-toggle="tooltip" title="Delete Game">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;
                });
            }
            
            $('#gamesTableBody').html(tableHtml);
            $('#gamesContainer').html(gridHtml);
            
            // Initialize tooltips
            const tooltips = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltips.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
            
            // Attach event listeners
            $('.edit-game-btn').click(function() {
                const gameId = $(this).data('id');
                editGame(gameId);
            });
            
            $('.delete-game-btn').click(function() {
                const gameId = $(this).data('id');
                confirmDeleteGame(gameId);
            });
        }
        
        // Rows per page change event
        $('#rowsPerPage').change(function() {
            rowsPerPage = parseInt($(this).val());
            totalPages = Math.ceil(allGames.length / rowsPerPage);
            displayPaginatedGames(1);
            updatePaginationControls();
        });
        
        // Helper function to get status color
        function getStatusColor(status) {
            switch(status.toLowerCase()) {
                case 'active': return 'success';
                case 'inactive': return 'secondary';
                case 'pending': return 'warning';
                case 'featured': return 'primary';
                default: return 'info';
            }
        }
        
        // Helper function to truncate text
        function truncateText(text, maxLength) {
            return text.length > maxLength ? text.substring(0, maxLength) + '...' : text;
        }
        
        // Save new category
        $('#saveCategory').click(function() {
            const formData = new FormData();
            formData.append('name', $('#categoryName').val());
            formData.append('image', $('#categoryImage')[0].files[0]);
            
            $.ajax({
                url: '{{ route('admin.categories.store') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#createCategoryModal').modal('hide');
                    $('#createCategoryForm')[0].reset();
                    loadCategories();
                    loadCategoriesForDropdown();
                    
                    // Show success notification
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Category created successfully',
                        timer: 1500,
                        showConfirmButton: false
                    });
                },
                error: function(xhr) {
                    const errors = xhr.responseJSON.errors;
                    let errorMessage = 'Error creating category: ';
                    for (const key in errors) {
                        errorMessage += errors[key][0] + ' ';
                    }
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorMessage
                    });
                }
            });
        });
        
        // Update category
        $('#updateCategory').click(function() {
            const categoryId = $('#editCategoryId').val();
            const formData = new FormData();
            formData.append('name', $('#editCategoryName').val());
            formData.append('_method', 'PUT');
            
            if ($('#editCategoryImage')[0].files.length > 0) {
                formData.append('image', $('#editCategoryImage')[0].files[0]);
            }
            
            $.ajax({
                url: '/admin/categories/' + categoryId,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#editCategoryModal').modal('hide');
                    $('#editCategoryForm')[0].reset();
                    loadCategories();
                    loadCategoriesForDropdown();
                    
                    // Show success notification
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Category updated successfully',
                        timer: 1500,
                        showConfirmButton: false
                    });
                },
                error: function(xhr) {
                    const errors = xhr.responseJSON.errors;
                    let errorMessage = 'Error updating category: ';
                    for (const key in errors) {
                        errorMessage += errors[key][0] + ' ';
                    }
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorMessage
                    });
                }
            });
        });
        
        // Delete category
        function deleteCategory(categoryId) {
            $.ajax({
                url: '/admin/categories/' + categoryId,
                type: 'DELETE',
                success: function(response) {
                    loadCategories();
                    loadCategoriesForDropdown();
                    loadGames();
                    
                    // Show success notification
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Category deleted successfully',
                        timer: 1500,
                        showConfirmButton: false
                    });
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error deleting category'
                    });
                }
            });
        }
        
        // Load categories for dropdown
        function loadCategoriesForDropdown() {
            $.get('{{ route('admin.categories.data') }}', function(data) {
                let options = '';
                data.categories.forEach(category => {
                    options += `<option value="${category.id}">${category.name}</option>`;
                });
                
                $('#gameCategory, #editGameCategory').html(options);
                
                // Also update filter dropdown
                let filterOptions = '<option value="all">All Categories</option>';
                data.categories.forEach(category => {
                    filterOptions += `<option value="${category.id}">${category.name}</option>`;
                });
                
                $('#filterCategory').html(filterOptions);
            });
        }
        
        // Load statuses for dropdown
        function loadStatusesForDropdown() {
            $.get('{{ route('admin.statuses.data') }}', function(data) {
                let options = '';
                data.statuses.forEach(status => {
                    options += `<option value="${status.id}">${status.name}</option>`;
                });
                
                $('#gameStatus, #editGameStatus').html(options);
            });
        }
        
        // Save new game
        $('#saveGame').click(function() {
            const formData = new FormData();
            formData.append('name', $('#gameName').val());
            formData.append('description', $('#gameDescription').val());
            formData.append('operating_system', $('#gameOS').val());
            formData.append('download_link', $('#gameDownloadLink').val());
            formData.append('category_id', $('#gameCategory').val());
            formData.append('status_id', $('#gameStatus').val());
            formData.append('image', $('#gameImage')[0].files[0]);
            
            if ($('#gameVideo')[0].files.length > 0) {
                formData.append('video', $('#gameVideo')[0].files[0]);
            }
            
            $.ajax({
                url: '{{ route('admin.games.store') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#createGameModal').modal('hide');
                    $('#createGameForm')[0].reset();
                    loadGames();
                    alert('Game created successfully!');
                },
                error: function(xhr) {
                    const errors = xhr.responseJSON.errors;
                    let errorMessage = 'Error creating game: ';
                    for (const key in errors) {
                        errorMessage += errors[key][0] + ' ';
                    }
                    alert(errorMessage);
                }
            });
        });
        
        // Update game
        $('#updateGame').click(function() {
            const gameId = $('#editGameId').val();
            const formData = new FormData();
            formData.append('name', $('#editGameName').val());
            formData.append('description', $('#editGameDescription').val());
            formData.append('operating_system', $('#editGameOS').val());
            formData.append('download_link', $('#editGameDownloadLink').val());
            formData.append('category_id', $('#editGameCategory').val());
            formData.append('status_id', $('#editGameStatus').val());
            formData.append('_method', 'PUT');
            
            if ($('#editGameImage')[0].files.length > 0) {
                formData.append('image', $('#editGameImage')[0].files[0]);
            }
            
            if ($('#editGameVideo')[0].files.length > 0) {
                formData.append('video', $('#editGameVideo')[0].files[0]);
            }
            
            $.ajax({
                url: '/admin/games/' + gameId,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#editGameModal').modal('hide');
                    $('#editGameForm')[0].reset();
                    loadGames();
                    alert('Game updated successfully!');
                },
                error: function(xhr) {
                    const errors = xhr.responseJSON.errors;
                    let errorMessage = 'Error updating game: ';
                    for (const key in errors) {
                        errorMessage += errors[key][0] + ' ';
                    }
                    alert(errorMessage);
                }
            });
        });
        
        // Delete game
        function deleteGame(gameId) {
            $.ajax({
                url: '/admin/games/' + gameId,
                type: 'DELETE',
                success: function(response) {
                    loadGames();
                    alert('Game deleted successfully!');
                },
                error: function() {
                    alert('Error deleting game');
                }
            });
        }
        
        // Event Listeners
        $('#filterCategory').change(function() {
            const categoryId = $(this).val();
            const searchTerm = $('#searchGame').val();
            loadGames(categoryId, searchTerm);
        });
        
        $('#searchGame').on('keyup', function() {
            const searchTerm = $(this).val();
            const categoryId = $('#filterCategory').val();
            loadGames(categoryId, searchTerm);
        });
        
        $('#searchCategory').on('keyup', function() {
            const searchTerm = $(this).val().toLowerCase();
            
            $('.category-card').each(function() {
                const categoryName = $(this).find('.card-title').text().toLowerCase();
                if (categoryName.includes(searchTerm)) {
                    $(this).parent().show();
                } else {
                    $(this).parent().hide();
                }
            });
        });
    });
</script>

<!-- Include SweetAlert2 for better notifications -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection 