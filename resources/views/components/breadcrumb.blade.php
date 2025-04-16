@php
    $segments = Request::segments();
@endphp

<nav aria-label="breadcrumb">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        @foreach ($segments as $index => $segment)
            @if ($index + 1 < count($segments))
                <li class="breadcrumb-item">
                    <a href="{{ url(implode('/', array_slice($segments, 0, $index + 1))) }}">
                        {{ ucfirst(str_replace('-', ' ', $segment)) }}
                    </a>
                </li>
            @else
                <li class="breadcrumb-item active" aria-current="page">
                    {{ ucfirst(str_replace('-', ' ', $segment)) }}
                </li>
            @endif
        @endforeach
    </ol>
</nav>
