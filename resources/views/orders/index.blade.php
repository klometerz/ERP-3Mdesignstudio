@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="d-flex justify-content-between align-items-center mb-4">
                
            </div>

            <h1 class="h3 mb-4">{{ $title ?? 'Data Order' }}</h1>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>Tanggal Order</th>
                        <th>Tanggal Selesai</th>
                        <th>Nilai Order</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
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
                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm">Detail</a>
                                <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus order ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada data order.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center mt-4">
                {{ $orders->links() }}
            </div>

        </div>
    </div>
</div>
@endsection
