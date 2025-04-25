@php
function highlight($text, $search) {
    if (!$search) {
        return e($text); // ⬅️ Escape dulu teks biar aman
    }

    $escapedText = e($text); // escape semua text normal dulu
    $pattern = "/" . preg_quote($search, '/') . "/i";

    return preg_replace_callback($pattern, function($match) {
        return '<span class="bg-warning">' . e($match[0]) . '</span>';
    }, $escapedText);
}
@endphp



@extends('layouts.app')

@section('content')

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3">Data Pegawai</h1>
        <a href="{{ route('pegawai.create') }}" class="btn btn-primary">+ Tambah Pegawai</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
    <div class="mb-3">
    <form action="{{ route('pegawai.index') }}" method="GET" class="d-flex">
        <input type="text" name="search" value="{{ request('search') }}" class="form-control me-2" placeholder="Cari pegawai..." autofocus>
        <button type="submit" class="btn btn-outline-primary">Cari</button>
    </form>
</div>

        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                <th>No</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Alamat</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($pegawai as $index => $item)

                    <tr>
                    <td>{{ ($pegawai->currentPage() - 1) * $pegawai->perPage() + $index + 1 }}</td>
                    <td>{!! highlight($item->nama, request('search')) !!}</td>
                    <td>{!! highlight($item->jabatan, request('search')) !!}</td>
                    <td>{!! highlight($item->alamat, request('search')) !!}</td>

                        <td class="text-center">
                            <a href="{{ route('pegawai.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('pegawai.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin mau hapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-3">
    {{ $pegawai->links() }}
</div>

    </div>
</div>
@endsection
