@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4">
            <div class="card border-0 mb-4">
                <div class="card-body text-center py-5">
                    <div class="mb-4">
                        <img src="https://ui-avatars.com/api/?name=Admin&background=4361ee&color=fff&size=128" alt="Admin" class="rounded-circle img-thumbnail" width="150">
                    </div>
                    <h4 class="mb-1">Admin User</h4>
                    <p class="text-muted mb-3">Administrator</p>
                    <div class="d-flex justify-content-center gap-2 mb-3">
                        <button class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-camera me-2"></i> Change Photo
                        </button>
                    </div>
                    <div class="border-top pt-3 mt-3">
                        <div class="row text-center">
                            <div class="col-6">
                                <h5 class="mb-0">{{ $categoriesCount ?? 0 }}</h5>
                                <small class="text-muted">Categories</small>
                            </div>
                            <div class="col-6">
                                <h5 class="mb-0">{{ $gamesCount ?? 0 }}</h5>
                                <small class="text-muted">Games</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card border-0">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Admin Information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <p class="mb-1 text-muted small">Email</p>
                        <p class="mb-0"><i class="fas fa-envelope me-2 text-primary"></i> admin@example.com</p>
                    </div>
                    <div class="mb-3">
                        <p class="mb-1 text-muted small">Role</p>
                        <p class="mb-0"><i class="fas fa-user-shield me-2 text-primary"></i> Administrator</p>
                    </div>
                    <div class="mb-3">
                        <p class="mb-1 text-muted small">Joined</p>
                        <p class="mb-0"><i class="fas fa-calendar-alt me-2 text-primary"></i> {{ date('F d, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-8">
            <div class="card border-0 mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Edit Profile</h5>
                </div>
                <div class="card-body">
                    <form id="profileForm">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" value="Admin">
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" value="admin@example.com">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="bio" class="form-label">Bio</label>
                            <textarea class="form-control" id="bio" rows="3" placeholder="Tell something about yourself...">Administrator at Ayoub Games</textarea>
                        </div>
                        
                        <button type="button" class="btn btn-primary" id="saveProfile">
                            <i class="fas fa-save me-2"></i> Save Changes
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="card border-0">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Change Password</h5>
                </div>
                <div class="card-body">
                    <form id="passwordForm">
                        <div class="mb-3">
                            <label for="currentPassword" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="currentPassword" placeholder="Enter current password">
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="newPassword" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="newPassword" placeholder="Enter new password">
                            </div>
                            <div class="col-md-6">
                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm new password">
                            </div>
                        </div>
                        
                        <button type="button" class="btn btn-primary" id="changePassword">
                            <i class="fas fa-lock me-2"></i> Update Password
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Handle profile update (mock implementation)
        $('#saveProfile').click(function() {
            // Show success message with animation
            const successAlert = `
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i> Profile updated successfully!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
            
            $(this).after(successAlert);
        });
        
        // Handle password update (mock implementation)
        $('#changePassword').click(function() {
            // Show success message with animation
            const successAlert = `
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i> Password updated successfully!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
            
            $(this).after(successAlert);
        });
    });
</script>
@endsection 