@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

        <div class="d-flex justify-content-between align-items-center mb-4">
    @include('components.breadcrumb')
</div>

<h1 class="h3 mb-4">{{ $title ?? 'Title' }}</h1>


            <div class="text-end mb-3">
                <a href="{{ route('pelanggan.create') }}" class="btn btn-primary">Tambah Pelanggan</a>
            </div>

            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Kota</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pelanggan as $index => $item)
                        <tr>
                            <td>{{ ($pelanggan->currentPage() - 1) * $pelanggan->perPage() + $index + 1 }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->telepon }}</td>
                            <td>{{ $item->kota }}</td>
                            <td>{{ $item->status_pelanggan }}</td>
                            <td class="text-center">
    <a href="{{ route('pelanggan.show', $item->id) }}" class="btn btn-info btn-sm">View</a>
    <a href="{{ route('pelanggan.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
    <form action="{{ route('pelanggan.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin mau hapus pelanggan ini?')">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger btn-sm">Hapus</button>
    </form>
</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-3">
                {{ $pelanggan->links() }}
            </div>

        </div>
    </div>
</div>
@endsection
