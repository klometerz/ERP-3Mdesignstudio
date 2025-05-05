@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h3 class="mb-4">{{ $title ?? 'Daftar Pelanggan' }}</h3>

   

    <div class="card shadow-sm">
        <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
        <form method="GET" class="d-flex">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control me-2" placeholder="Cari pelanggan...">
            <button class="btn btn-outline-primary">Cari</button>
        </form>
        <a href="{{ route('pelanggan.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i>Tambah Pelanggan</a>
    </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle table-sm mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Kota</th>
                            <th>Status</th>
                            <th class="text-center" style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pelanggan as $index => $item)
                            <tr>
                                <td>{{ ($pelanggan->currentPage() - 1) * $pelanggan->perPage() + $index + 1 }}</td>
                                <td><x-highlight :text="$item->nama" :search="request('search')" /></td>
                                <td><x-highlight :text="$item->email" :search="request('search')" /></td>
                                <td><x-highlight :text="$item->telepon" :search="request('search')" /></td>
                                <td><x-highlight :text="$item->kota" :search="request('search')" /></td>
                                <td>
                                    <span class="badge {{ $item->status_pelanggan === 'Aktif' ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $item->status_pelanggan }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('pelanggan.show', $item->id) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('pelanggan.edit', $item->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('pelanggan.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin mau hapus pelanggan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"> <i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">Belum ada data pelanggan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">
        {{ $pelanggan->links() }}
    </div>
</div>
@endsection
