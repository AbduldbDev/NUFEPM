@extends('layouts.app')
@section('content')
    <div class="container main-container">
        @if (Route::currentRouteName() == 'admin.ShowRetiredExtinguishers' ||
                Route::currentRouteName() == 'admin.ShowActiveExtinguishers')
            @include('Admin.SubMenu.Components.BreadCrumbs.Extinguishers')
        @elseif(Route::currentRouteName() == 'admin.ShowInspectionExtinguishers')
            @include('Admin.SubMenu.Components.BreadCrumbs.InspectionExtinguisher')
        @endif

        <div class="menu-grid">
            @if (Route::currentRouteName() == 'admin.ShowActiveExtinguishers')
                @include('Admin.SubMenu.Components.Cards.ActiveExtinguisher')
            @elseif (Route::currentRouteName() == 'admin.ShowRetiredExtinguishers')
                @include('Admin.SubMenu.Components.Cards.RetiredExtinguisher')
            @elseif (Route::currentRouteName() == 'admin.ShowInspectionExtinguishers')
                @include('Admin.SubMenu.Components.Cards.InspectionExtinguishers')
            @endif

            @foreach ($items as $item)
                <div class="menu-card position-relative">
                    <a href="{{ url($url . $item->name) }}" class="card-link"></a>
                    <div class="card-body">
                        <div class="card-icon-container">
                            <div class="card-icon">
                                <i class="{{ $item->icon }}"></i>
                            </div>
                        </div>
                        <h3 class="card-title">{{ $item->name }}</h3>
                        <p class="card-description">
                            {{ $item->extinguisher_count ?? 0 }} {{ $type }}
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
