@php
function highlight($text, $search) {
    if (!$search) {
        return e($text); 
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
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Data Pegawai</h3>
        <a href="{{ route('pegawai.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg"></i>Pegawai</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('pegawai.index') }}" method="GET" class="d-flex mb-3">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control me-2" placeholder="Cari pegawai..." autofocus>
                <button type="submit" class="btn btn-outline-primary">Cari</button>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle table-sm">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 5%;">#</th>
                            <th style="width: 25%;">Nama</th>
                            <th style="width: 20%;">Jabatan</th>
                            <th style="width: 30%;">Alamat</th>
                            <th class="text-center" style="width: 20%;">Aksi</th>
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
                                <a href="{{ route('pegawai.edit', $item->id) }}" class="btn btn-sm btn-warning"> <i class="bi bi-pencil"></i></a>
                                <form action="{{ route('pegawai.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin mau hapus?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
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
    </div>
</div>
@endsection
