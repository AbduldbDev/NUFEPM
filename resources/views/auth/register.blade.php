@extends('auth.app')

@section('content')
    <div class="container mt-5">
        <h3 class="mb-4">Register</h3>
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="uid" class="form-label">User ID</label>
                <input type="text" name="uid" id="uid" class="form-control" value="{{ old('uid') }}" required>
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">User Type</label>
                <select name="type" id="type" class="form-select" required>
                    <option value="">-- Select --</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                    <!-- Add more types if needed -->
                </select>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                    required>
            </div>

            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <select name="gender" id="gender" class="form-select" required>
                    <option value="">-- Select --</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Profile Image</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
@endsection
