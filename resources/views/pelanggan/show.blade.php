@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h3 class="mb-4">
        @if(auth()->user()->role->name === 'pelanggan')
            {{ $pelanggan->nama }}
        @else
            {{ $title ?? 'Detail Pelanggan' }}
        @endif
    </h3>

    @auth
        @if(auth()->user()->role->name === 'admin' && $pelanggan->plain_password)
            <div class="alert alert-info d-flex justify-content-between align-items-center">
                <div><strong>Password Akun:</strong> {{ $pelanggan->plain_password }}</div>
                <form action="{{ route('pelanggan.clearPassword', $pelanggan->id) }}" method="POST">
                    @csrf @method('PATCH')
                    <button class="btn btn-sm btn-danger">Hapus Password</button>
                </form>
            </div>
        @endif
    @endauth

    <div class="row">
        {{-- Info Pelanggan --}}
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ $pelanggan->nama }}</h5>
                    <table class="table table-sm table-borderless mb-0">
                        <tr><th>Email</th><td>: {{ $pelanggan->email }}</td></tr>
                        <tr><th>Telepon</th><td>: {{ $pelanggan->telepon }}</td></tr>
                        <tr><th>Alamat</th><td>: {{ $pelanggan->alamat }}</td></tr>
                        <tr><th>Kota</th><td>: {{ $pelanggan->kota }}</td></tr>
                        <tr><th>Provinsi</th><td>: {{ $pelanggan->provinsi }}</td></tr>
                        <tr><th>Negara</th><td>: {{ $pelanggan->negara }} ({{ $pelanggan->kode_negara }})</td></tr>
                        <tr><th>Zipcode</th><td>: {{ $pelanggan->zipcode }}</td></tr>
                        <tr>
                            <th>Status</th>
                            <td>: 
                                <span class="badge {{ $pelanggan->status_pelanggan === 'Aktif' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $pelanggan->status_pelanggan }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        {{-- Daftar Order --}}
        <div class="col-md-8">
            @if(auth()->user()->role->name === 'admin')
                <a href="{{ route('orders.create', ['pelanggan_id' => $pelanggan->id]) }}" class="btn btn-success mb-3">+ Tambah Order Baru</a>
            @endif

            <h5 class="mb-3">Daftar Orders</h5>

            @if($pelanggan->orders->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover table-sm align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Tanggal Order</th>
                                <th>Nilai</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pelanggan->orders as $index => $order)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $order->tanggal_order }}</td>
                                    <td>Rp {{ number_format($order->nilai_order, 0, ',', '.') }}</td>
                                    <td>{{ $order->status_order }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-info">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted">Belum ada order untuk pelanggan ini.</p>
            @endif

            @if(auth()->user()->role->name === 'admin')
                <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary mt-3">← Kembali ke Daftar</a>
            @endif
        </div>
    </div>
</div>
@endsection
