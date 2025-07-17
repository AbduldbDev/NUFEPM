@extends('layouts.app')
@section('content')
    @include('layouts.components.alerts')

    <div class="main-container container">
        <div class="title">
            <span class="menu-title-icon"><i class="fa-solid fa-users"></i></span> &nbsp;
            <span class="crumb">
                <span class="breadcrumbs"><a href="{{ route('dashboard') }}">Home</a> &gt; </span>
            </span>
            <span class="crumb">
                <span class="breadcrumbs"><a href="{{ route('admin.ShowAccountsMenu') }}">Accounts</a> &gt; </span>
            </span>
            <span class="breadcrumbs">Change Password </span>
        </div>
        <hr>

        <div class="animated-container">
            <div class="container d-flex  mt-5">
                <div class="col-md-6">
                    <div class="form-container shadow-sm p-4 bg-white rounded-3">
                        <h4 class="form-title mb-3  text-start">
                            <i class="fa-solid fa-key me-2"></i> Change Password
                        </h4>
                        <hr>

                        <form method="POST" action="{{ route('admin.ChangePasswowrd') }}">
                            @method('PUT')
                            @csrf

                            <div class="mb-3">
                                <label for="current_password" class="form-label">Current Password <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="password" name="current_password" id="current_password"
                                        class="form-control" required>
                                    <button type="button" class="btn btn-outline-secondary toggle-password"
                                        data-target="current_password">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="new_password" class="form-label">New Password <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="password" name="new_password" id="new_password" class="form-control"
                                        required minlength="8">
                                    <button type="button" class="btn btn-outline-secondary toggle-password"
                                        data-target="new_password">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="new_password_confirmation" class="form-label">Confirm New Password <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                                        class="form-control" required>
                                    <button type="button" class="btn btn-outline-secondary toggle-password"
                                        data-target="new_password_confirmation">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn save-btn w-100 mt-3">
                                    <i class="fa-solid fa-save me-2"></i> Update Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', () => {
                const targetId = button.getAttribute('data-target');
                const input = document.getElementById(targetId);

                if (input.type === 'password') {
                    input.type = 'text';
                    button.innerHTML = '<i class="fa fa-eye-slash"></i>';
                } else {
                    input.type = 'password';
                    button.innerHTML = '<i class="fa fa-eye"></i>';
                }
            });
        });
    </script>
@endsection
@push('css')
    <link href="{{ asset('css/custom.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/components/submenu.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
