@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h3 class="mb-4">{{ $title ?? 'Data Order' }}</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <div class="card shadow-sm">
        <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
    <form method="GET" class="mb-3 d-flex">
        <input type="text" name="search" value="{{ request('search') }}" class="form-control me-2" placeholder="Cari berdasarkan nama pelanggan...">
        <button class="btn btn-outline-primary">Cari</button>
    </form>
</div>
            <div class="table-responsive">
                <table class="table table-hover align-middle table-sm mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th style="width: 20%;">Nama Pelanggan</th>
                            <th style="width: 15%;">Tgl Order</th>
                            <th style="width: 15%;">Tgl Selesai</th>
                            <th style="width: 15%;">Nilai Order</th>
                            <th style="width: 15%;">Status</th>
                            <th class="text-center" style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $index => $order)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $order->pelanggan->nama ?? '-' }}</td>
                                <td>{{ $order->tanggal_order }}</td>
                                <td>{{ $order->tanggal_selesai_order }}</td>
                                <td>Rp {{ number_format($order->nilai_order, 0, ',', '.') }}</td>
                                <td>{{ $order->status_order }}</td>
                                <td class="text-center">
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus order ini?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">Belum ada data order.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $orders->links() }}
    </div>
</div>
@endsection
