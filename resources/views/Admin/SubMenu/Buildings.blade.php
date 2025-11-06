@extends('layouts.app')
@section('content')
    <div class="container main-container">
        <div class="breadcrumb-container">
            <div class="breadcrumb-back">
                <a href="javascript:history.back()" class="back-button">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
            </div>
            <div class="breadcrumb-icon">
                <i class="fa-solid  fa-school-flag"></i>
            </div>
            <nav class="breadcrumb-nav">
                <div class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Home</a>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <div class="breadcrumb-item active">
                    <span>Locations</span>
                </div>
            </nav>
        </div>
        <div class="menu-grid">
            <div class="menu-card">
                <a href="{{ url('Locations/buildings/new') }}" class="card-link"></a>
                <div class="card-body">
                    <div class="card-icon-container">
                        <div class="card-icon">
                            <i class="fa-solid fa-plus"></i>
                        </div>
                    </div>
                    <h3 class="card-title">Add New Building</h3>
                    <p class="card-description">
                        Add a new building to the system and manage its details.
                    </p>

                </div>
            </div>

            @foreach ($items as $item)
                @include('Admin.locations.modals.editbuilding')
                <div class="menu-card position-relative">
                    <div class="card-actions"
                        style="z-index: 10; position: absolute; top: 10px; right: 10px; display: flex; gap: 8px;">
                        <button class="edit-btn" style="color: #35408e; border: none; background-color: transparent"
                            data-bs-toggle="modal" data-bs-target="#editBuildingModal{{ $item->id }}">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>

                        <form action="{{ route('admin.DeleteBuilding') }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this building?');">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <button type="submit" class="text-danger" style="border: none; background: transparent;"
                                title="Delete">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>

                    <a href="{{ url('Locations/building/' . $item->name) }}" class="card-link"></a>
                    <div class="card-body">
                        <div class="card-icon-container">
                            <div class="card-icon">
                                <i class="{{ $item->icon }}"></i>
                            </div>
                        </div>
                        <h3 class="card-title">{{ $item->name }}</h3>
                        <p class="card-description">
                            {{ $item->description }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@push('css')
    <link href="{{ asset('css/components/menu.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
