@extends('admin.main')
@section('content')
    <div class="container mt-5 d-flex justify-content-center align-items-center">
        <div class="col-md-8">
            <!-- Profile Information Section -->
            <div class="card mt-5">
                <div class="card-header">
                    <h5 class="fw-bold">Profile Information</h5>
                    <p>Update your account's profile information and email address.</p>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @method('PATCH')
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ old('email', $user->email) }}" required autocomplete="username">
                        </div>
                        <button type="submit" class="btn btn-md btn-dark">Save Changes</button>
                    </form>
                    @if (session('status') === 'profile-updated')
                    <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                Toastify({
                                    text: "Your profile is successfully updated!",
                                    duration: 5000,
                                    gravity: "top",
                                    position: "right",
                                    backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                                    stopOnFocus: true,
                                    close: true,
                                    icon: "fa fa-check-circle",
                                    style: {
                                        borderRadius: "10px",
                                        boxShadow: "0 4px 6px rgba(0, 0, 0, 0.1)",
                                        fontSize: "16px",
                                        padding: "10px 20px",
                                        color: "#fff",
                                    },
                                    onClick: function() {
                                        Toastify().hideToast();
                                    }
                                }).showToast();
                            });
                        </script>
                    @endif
                </div>
            </div>

            <!-- Update Password Section -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="fw-bold">Update Password</h5>
                    <p>Ensure your account is using a long, random password to stay secure.</p>
                </div>
                <div class="card-body">
                    <form action="{{ route('password.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Current Password Field -->
                        <div class="mb-3">
                            <label for="current-password" class="form-label">Current Password</label>
                            <input type="password"
                                class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                                id="current-password" name="current_password">
                            @error('current_password', 'updatePassword')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- New Password Field -->
                        <div class="mb-3">
                            <label for="new-password" class="form-label">New Password</label>
                            <input type="password"
                                class="form-control @error('password', 'updatePassword') is-invalid @enderror"
                                id="new-password" name="password">
                            @error('password', 'updatePassword')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="mb-3">
                            <label for="password-confirmation" class="form-label">Confirm Password</label>
                            <input type="password"
                                class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror"
                                id="password-confirmation" name="password_confirmation" required>
                            @error('password_confirmation', 'updatePassword')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-md btn-dark">Save Changes</button>
                    </form>

                    <!-- Success Message -->
                    @if (session('status') === 'password-updated')
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                Toastify({
                                    text: "Your password is successfully updated!",
                                    duration: 5000,
                                    gravity: "top",
                                    position: "right",
                                    backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                                    stopOnFocus: true,
                                    close: true,
                                    icon: "fa fa-check-circle",
                                    style: {
                                        borderRadius: "10px",
                                        boxShadow: "0 4px 6px rgba(0, 0, 0, 0.1)",
                                        fontSize: "16px",
                                        padding: "10px 20px",
                                        color: "#fff",
                                    },
                                    onClick: function() {
                                        Toastify().hideToast();
                                    }
                                }).showToast();
                            });
                        </script>
                    @endif
                </div>

            </div>


            <!-- Delete Account Section -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="fw-bold">Delete Account</h5>
                    <p>Once your account is deleted, all of its resources and data will be permanently deleted. Before
                        deleting your account, please download any data or information that you wish to retain.</p>
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-md btn-danger" data-bs-toggle="modal"
                        data-bs-target="#confirmDeleteModal">
                        Delete Account
                    </button>

                    <!-- Password Confirmation Modal -->
                    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Account Deletion</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Please enter your password to confirm account deletion.</p>
                                    <form id="deleteAccountForm" action="{{ route('profile.destroy') }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" name="password" id="password" class="form-control"
                                                required>
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-danger me-2">Delete Account</button>
                                            <button type="button" class="btn btn-dark"
                                                data-bs-dismiss="modal">Cancel</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@section('script')
    <script src="{{ asset('backend/assets/js/core/jquery-3.7.1.min.js') }}"></script>
@endsection
@endsection
