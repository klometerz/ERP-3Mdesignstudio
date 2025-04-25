<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ERP - 3M Design Studio')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Optional: Bootstrap CDN (if not fully using Tailwind) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light text-dark">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                🏗️ ERP 3M Studio
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
    @auth
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            @switch(auth()->user()->role->name)
                @case('admin')
                    <li class="nav-item"><a class="nav-link" href="{{ route('pelanggan.index') }}">Pelanggan</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('orders.index') }}">Orders</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('pegawai.index') }}">Pegawai</a></li>
                    @break

                    @case('pelanggan')
    {{-- Optional: navbar placeholder non-clickable --}}
    <li class="nav-item">
        <span class="nav-link disabled text-muted">Profil Saya</span>
    </li>
    @break

            @endswitch
        </ul>

        {{-- Kanan: User Dropdown --}}
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                    {{ auth()->user()->name }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Edit Profil</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="dropdown-item text-danger">Logout</button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    @else
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
        </ul>
    @endauth
</div>

        </div>
    </nav>

    <main class="container py-4">
        {{-- Flash Notif --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        {{-- Breadcrumb (Optional) --}}
        @include('components.breadcrumb')

        {{-- Page Title --}}
        <h1 class="h3 mb-4">@yield('title')</h1>

        {{-- Page Content --}}
        @yield('content')
    </main>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
