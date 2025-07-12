@extends('auth.app')

@section('content')
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box"
                style="background: #323e8f;">
                <div class="featured-image mb-3">
                    <img src="{{ asset('/Image/NULogo.png') }}" class="img-fluid" style="width: 250px;">
                </div>
            </div>

            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    <div class="header-text mb-4">
                        <h2>Hello, Again</h2>
                        <p>Fire Extinguisher Preventive Maintenance</p>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="input-group mb-3">
                            <input type="email" name="email" id="email"
                                class="form-control form-control-lg bg-light fs-6 @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" required autofocus>
                        </div>
                        <div style="min-height: 20px; overflow-wrap: break-word;" class="text-danger small">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </div>

                        <div class="input-group mb-1">
                            <input type="password" name="password" id="password"
                                class="form-control form-control-lg bg-light fs-6 @error('password') is-invalid @enderror"
                                required>
                            <span class="input-group-text bg-light" onclick="togglePassword()" style="cursor: pointer;">
                                <i class="fa-solid fa-eye" id="togglePasswordIcon"></i>
                            </span>
                        </div>
                        <div style="min-height: 20px;" class="text-danger small">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </div>

                        <div class="input-group mb-5 d-flex justify-content-between">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="formCheck">
                                <label for="formCheck" class="form-check-label text-secondary"><small>Remember
                                        Me</small></label>
                            </div>
                            <div class="forgot">
                                <small><a href="#">Forgot Password?</a></small>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <button class="btn btn-lg btn-primary w-100 fs-6">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('/js/Auth/togglepass.js') }}"></script>
@endsection
@push('css')
    <link href="{{ asset('css/auth.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
