@extends('auth.app')

@section('content')
    <div class="container-fluid p-0 vh-100">
        <div class="row g-0 h-100">

            <div class="col-lg-6 col-12 d-flex align-items-center justify-content-center py-4 px-3 bg-login"
                id="loginSection">
                <div class="w-100" style="max-width: 400px;">
                    <div class="header-text mb-4 text-center text-lg-start">
                        <div class="featured-image mb-3 d-lg-none">
                            <img src="{{ asset('/Image/NULogo.png') }}" class="img-fluid" style="max-width: 120px;">
                        </div>
                        <h2 class="fw-bold  mb-2 fs-4" style="color: #35408e">Welcome Back</h2>
                        <p class="text-muted fs-6">Fire Extinguisher Preventive Maintenance System</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold small">Email Address</label>
                            <div class="input-group @error('email') has-validation @enderror">
                                <span
                                    class="input-group-text bg-light border-end-0 py-2 
                                    @error('email') border-danger text-danger bg-light @enderror">
                                    <i class="fas fa-envelope small"></i>
                                </span>
                                <input type="email" name="email" id="email"
                                    class="form-control py-2 border-start-0 @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" required autofocus placeholder="Enter your email">
                            </div>
                            <div class="min-height-20 text-danger small mt-1 ps-3">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold small">Password</label>
                            <div class="input-group @error('password') has-validation @enderror position-relative">
                                <span
                                    class="input-group-text bg-light border-end-0 py-2 
                                        @error('password') border-danger text-danger bg-light @enderror">
                                    <i class="fas fa-lock small"></i>
                                </span>
                                <input type="password" name="password" id="password"
                                    class="form-control py-2 border-start-0 pe-5 @error('password') is-invalid @enderror"
                                    required placeholder="Enter your password">
                                <span class="position-absolute end-0 top-50 translate-middle-y me-2"
                                    onclick="togglePassword()" style="cursor: pointer; z-index: 5;">
                                    <i class="fas fa-eye text-muted small" id="togglePasswordIcon"></i>
                                </span>
                            </div>
                            <div class="min-height-20 text-danger small mt-1 ps-3">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="formCheck" name="remember">
                                <label for="formCheck" class="form-check-label text-muted small">Remember Me</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <button style="background-color: #35408e" class="btn text-white w-100 fw-bold py-2 small">
                                <i class="fas fa-sign-in-alt me-1"></i>Login to System
                            </button>
                        </div>
                    </form>

                    <div class="d-lg-none text-center mt-4">
                        <button type="button" class="btn btn-outline-primary btn-sm fw-bold" id="toggleHotlinesBtn">
                            <i class="fas fa-phone-alt me-1"></i>View Emergency Hotlines
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-12 d-none d-lg-flex position-relative" id="hotlinesSection">

                <div class="position-absolute w-100 h-100">
                    <img src="{{ asset('/Image/bg.webp') }}" class="w-100 h-100 object-fit-cover" alt="Emergency Background"
                        onerror="this.style.display='none'">
                </div>

                <div class="position-absolute w-100 h-100"
                    style="background: linear-gradient(135deg, rgba(0,0,0,0.7) 0%, rgba(50,62,143,0.8) 100%);"></div>

                <div class="position-relative w-100 h-100 d-flex align-items-center justify-content-center p-4">
                    <div class="w-100 h-100 d-flex flex-column" style="max-width: 500px;">

                        <div class="d-lg-none text-end mb-3">
                            <button type="button" class="btn btn-outline-light btn-sm" id="backToLoginBtn">
                                <i class="fas fa-arrow-left me-1"></i>Back to Login
                            </button>
                        </div>

                        <div class="text-center mb-4">
                            <img src="{{ asset('/Image/NULogo.png') }}" class="img-fluid mb-2" style="max-width: 80px;">
                            <h5 class="text-white fw-bold mb-1">Emergency Response Portal</h5>
                            <p class="text-white text-opacity-75 small">Always Ready, Always Available</p>
                        </div>

                        <div class="mb-4 flex-grow-1">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h6 class="text-white fw-bold mb-0">Emergency Hotlines</h6>
                                <span class="badge bg-warning text-dark small">24/7 Available</span>
                            </div>

                            <div class="row g-2">
                                @php
                                    $displayedLocations = [];
                                    $locationCount = 0;
                                @endphp

                                @foreach ($hotlines as $hotline)
                                    @if (!in_array($hotline['location'], $displayedLocations))
                                        @if ($locationCount > 0)
                            </div>
                        </div>
                        @endif
                        @php
                            $displayedLocations[] = $hotline['location'];
                            $locationCount++;
                        @endphp
                        <div class="col-12 mb-2">
                            <div class="location-section ">
                                <h6 class="text-warning fw-bold mb-2 small border-bottom pb-1">{{ $hotline['location'] }}
                                </h6>
                                <div class="row g-2">
                                    @endif
                                    <div class="col-6">
                                        <a href="tel:{{ $hotline['number'] }}" class="text-decoration-none">
                                            <div
                                                class="hotline-card bg-white bg-opacity-10 text-white rounded-2 p-2 border-0 h-100">
                                                <div class="d-flex align-items-start">
                                                    <div class="hotline-icon me-2">
                                                        <i class="fas fa-phone-alt text-warning small"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div class="fw-bold micro mb-1">{{ $hotline['label'] }}</div>
                                                        <div class="small fw-bold text-warning">{{ $hotline['number'] }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="mt-3">
                    <h6 class="text-white fw-bold mb-3 small">Building Emergency Plans</h6>
                    <div class="row g-2">
                        @php
                            $buildings = [
                                [
                                    'name' => 'Educ Building',
                                    'url' => asset('pdf/EDUC.pdf'),
                                    'icon' => 'fa-graduation-cap',
                                ],
                                [
                                    'name' => 'AGETAC Building',
                                    'url' => asset('pdf/AGETAC.pdf'),
                                    'icon' => 'fa-flask',
                                ],
                                [
                                    'name' => 'Dormitel Building',
                                    'url' => asset('pdf/DORMITEL.pdf'),
                                    'icon' => 'fa-bed',
                                ],
                                [
                                    'name' => 'Sports Academy',
                                    'url' => asset('pdf/INSPIRE.pdf'),
                                    'icon' => 'fa-trophy',
                                ],
                            ];
                        @endphp

                        @foreach ($buildings as $building)
                            <div class="col-6 col-sm-3">
                                <a href="{{ $building['url'] }}" target="_blank" class="text-decoration-none">
                                    <div class="emergency-plan-card text-center p-2 rounded-2 bg-white bg-opacity-10 text-white border-0"
                                        style="transition: all 0.3s ease; backdrop-filter: blur(5px); height: 90px; display: flex; flex-direction: column; justify-content: center;"
                                        onmouseover="this.style.transform='translateY(-3px)'; this.style.background='rgba(255,255,255,0.15)'"
                                        onmouseout="this.style.transform='translateY(0)'; this.style.background='rgba(255,255,255,0.1)'">

                                        <div class="building-icon mb-2 d-flex justify-content-center">
                                            <div class="icon-wrapper bg-white bg-opacity-20 rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 50px; height: 50px;">
                                                <i class="fas {{ $building['icon'] }} text-warning"
                                                    style="font-size: 22px;"></i>
                                            </div>
                                        </div>

                                        <div class="fw-semibold micro text-truncate px-1" style="font-size: 11px;">
                                            {{ $building['name'] }}
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>

            <div class="mt-3 pt-2 border-top border-white border-opacity-25">
                <div class="text-center">
                    <p class="text-white text-opacity-75 micro mb-0">
                        <i class="fas fa-exclamation-triangle text-warning me-1"></i>
                        In case of emergency, call hotlines immediately
                    </p>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script src="{{ asset('/js/Auth/togglepass.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('toggleHotlinesBtn');
            const backToLoginBtn = document.getElementById('backToLoginBtn');
            const loginSection = document.getElementById('loginSection');
            const hotlinesSection = document.getElementById('hotlinesSection');

            toggleBtn.addEventListener('click', function() {
                loginSection.classList.add('d-none');
                hotlinesSection.classList.remove('d-none');
                hotlinesSection.classList.add('d-flex');
                document.body.style.overflow = 'hidden';
            });

            backToLoginBtn.addEventListener('click', function() {
                hotlinesSection.classList.add('d-none');
                hotlinesSection.classList.remove('d-flex');
                loginSection.classList.remove('d-none');
                document.body.style.overflow = 'auto';
            });

            window.addEventListener('popstate', function() {
                hotlinesSection.classList.add('d-none');
                hotlinesSection.classList.remove('d-flex');
                loginSection.classList.remove('d-none');
                document.body.style.overflow = 'auto';
            });
        });
    </script>
@endsection

@push('css')
    <link href="{{ asset('css/auth.css') }}?v={{ time() }}" rel="stylesheet">
    <style>
        .bg-login {
            background: linear-gradient(135deg, #f8f9ff 0%, #e8ebfa 100%);
            position: relative;
            overflow: hidden;
        }

        .bg-login::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image: radial-gradient(rgba(53, 64, 142, 0.08) 1px, transparent 1px);
            background-size: 20px 20px;
            z-index: 0;
        }

        .bg-login>div {
            position: relative;
            z-index: 1;
        }

        .min-height-20 {
            min-height: 20px;
        }

        .cursor-pointer {
            cursor: pointer;
        }

        .micro {
            font-size: 0.7rem;
        }

        .hotline-card {
            transition: all 0.3s ease;
            backdrop-filter: blur(5px);
        }

        .hotline-card:hover {
            transform: translateY(-1px);
            background: rgba(255, 255, 255, 0.15) !important;
        }

        .emergency-plan-card {
            min-height: 80px;
        }

        .object-fit-cover {
            object-fit: cover;
        }

        @media (max-width: 991.98px) {
            #hotlinesSection {
                background: linear-gradient(135deg, #323e8f 0%, #1e2a78 100%);
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100vh;
                z-index: 1000;
                overflow-y: auto;
            }

            .container-fluid {
                overflow-y: auto;
            }

            .small {
                font-size: 0.8rem !important;
            }

            .micro {
                font-size: 0.65rem !important;
            }

            .hotline-card {
                backdrop-filter: none;
            }
        }

        @media (min-width: 992px) {
            .vh-100 {
                height: 100vh !important;
                overflow: hidden;
            }

            #toggleHotlinesBtn,
            #backToLoginBtn {
                display: none !important;
            }

            #hotlinesSection {
                display: flex !important;
            }
        }

        .emergency-plan-card {
            height: 100px !important;
        }

        .position-relative .small {
            font-size: 0.75rem;
        }

        .position-relative .micro {
            font-size: 0.7rem;
        }

        #loginSection,
        #hotlinesSection {
            transition: all 0.3s ease-in-out;
        }
    </style>
@endpush
