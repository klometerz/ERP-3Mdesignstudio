<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ERP - 3M Design Studio')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body class="bg-light text-dark">

    <div class="d-flex flex-column min-vh-100">

        {{-- Topbar --}}
        @include('partials.topbar')

        <div class="d-flex flex-grow-1">
            {{-- Sidebar --}}
            @include('partials.sidebar')

            {{-- Main Content --}}
            <main class="container py-4">
                {{-- Flash Notif --}}
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @elseif (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                {{-- Breadcrumb --}}
                @include('components.breadcrumb')

                {{-- Title --}}
                <h1 class="h3 mb-4">@yield('title')</h1>

                {{-- Content --}}
                @yield('content')
            </main>
        </div>

        {{-- Footer --}}
        @include('partials.footer')

    </div>
    <script>
    document.getElementById('sidebarToggle')?.addEventListener('click', function () {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('d-none');
    });
</script>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</html>
