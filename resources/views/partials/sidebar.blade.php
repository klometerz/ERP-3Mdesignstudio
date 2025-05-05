@php
    $role = auth()->user()->role->name ?? null;
    $route = request()->route()->getName();
@endphp
<style>
    .nav-link.active {
    background-color: #0d6efd !important;
    color: #fff !important;
}

    </style>
<!--<aside class="bg-white border-end shadow-sm vh-100" style="width: 240px;">
    <div class="p-3">
        <h5 class="text-primary fw-bold mb-4">📁 Menu</h5>

       
    </div>
</aside>-->
<aside id="sidebar" class="bg-dark text-white p-3 vh-100 position-fixed d-none d-md-block" style="width: 250px;">
    <h5 class="text-white mb-4">---------------------------</h5>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link text-white {{ str_contains(Route::currentRouteName(), 'dashboard') ? 'active fw-bold' : '' }}" href="{{ route('dashboard') }}">
                <i class="bi bi-house me-2"></i> Dashboard
            </a>
        </li>
        <ul class="nav nav-pills flex-column gap-1">

@if($role === 'admin')
    <li class="nav-item">
        <a class="nav-link {{ str_starts_with($route, 'pelanggan') ? 'active' : '' }}" href="{{ route('pelanggan.index') }}">
            <i class="bi bi-people-fill me-2"></i> Pelanggan
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ str_starts_with($route, 'orders') ? 'active' : '' }}" href="{{ route('orders.index') }}">
            <i class="bi bi-basket2-fill me-2"></i> Orders
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ str_starts_with($route, 'pegawai') ? 'active' : '' }}" href="{{ route('pegawai.index') }}">
            <i class="bi bi-person-badge-fill me-2"></i> Pegawai
        </a>
    </li>
@endif

{{-- Shared --}}
<li class="nav-item">
    <a class="nav-link {{ str_starts_with($route, 'profile') ? 'active' : '' }}" href="{{ route('profile.edit') }}">
        <i class="bi bi-person-circle me-2"></i> Profil Saya
    </a>
</li>
</ul>
    </ul>
</aside>