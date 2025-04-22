@extends('layouts.app')

@section('content')
<div class="container">
<div class="d-flex justify-content-between align-items-center mb-4">
    @include('components.breadcrumb')
</div>

<h1 class="h3 mb-4">{{ $title ?? 'Title' }}</h1>
@auth
    @if(auth()->user()->role->name === 'admin' && $pelanggan->plain_password)
        <div class="alert alert-info mt-3">
            <strong>Password Akun:</strong> {{ $pelanggan->plain_password }}
        </div>
        <form action="{{ route('pelanggan.clearPassword', $pelanggan->id) }}" method="POST">
    @csrf
    @method('PATCH')
    <button class="btn btn-sm btn-danger mt-2">Hapus Password Akun</button>
</form>

    @endif
@endauth


    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $pelanggan->nama }}</h5>
            <p class="card-text"><strong>Email:</strong> {{ $pelanggan->email }}</p>
            <p class="card-text"><strong>Telepon:</strong> {{ $pelanggan->telepon }}</p>
            <p class="card-text"><strong>Alamat:</strong> {{ $pelanggan->alamat }}</p>
            <p class="card-text"><strong>Kota:</strong> {{ $pelanggan->kota }}</p>
            <p class="card-text"><strong>Provinsi:</strong> {{ $pelanggan->provinsi }}</p>
            <p class="card-text"><strong>Negara:</strong> {{ $pelanggan->negara }} ({{ $pelanggan->kode_negara }})</p>
            <p class="card-text"><strong>Zipcode:</strong> {{ $pelanggan->zipcode }}</p>
            <p class="card-text"><strong>Status Pelanggan:</strong> {{ $pelanggan->status_pelanggan }}</p>
        </div>
    </div>
    <div class="mb-4">
    <a href="{{ route('orders.create', ['pelanggan_id' => $pelanggan->id]) }}" class="btn btn-success">
        Tambah Order Baru
    </a>
</div>

<h3 class="h3 mb-4">Daftar Orders</h3>

@if($pelanggan->orders->count() > 0)
    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Tanggal Order</th>
                <th>Nilai Order</th>
                <th>Status Order</th>
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
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm">Detail</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>Belum ada Order untuk pelanggan ini.</p>
@endif


    <div class="mt-4">
        <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
    </div>
</div>

@endsection
