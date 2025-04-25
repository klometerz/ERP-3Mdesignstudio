@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
      
    </div>

    <h1 class="h3 mb-4">
        @if(auth()->user()->role->name === 'pelanggan')
            {{ $pelanggan->nama }}
        @else
            {{ $title ?? 'Detail Pelanggan' }}
        @endif
    </h1>

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

    <div class="card mt-4">
    <div class="card-body fs-6">
        <h5 class="card-title mb-4">{{ $pelanggan->nama }}</h5>

        <table class="table table-bordered">

            <tbody>
                <tr>
                    <th scope="row" style="width: 200px;">Email</th>
                    <td>: {{ $pelanggan->email }}</td>
                </tr>
                <tr>
                    <th scope="row">Telepon</th>
                    <td>: {{ $pelanggan->telepon }}</td>
                </tr>
                <tr>
                    <th scope="row">Alamat</th>
                    <td>: {{ $pelanggan->alamat }}</td>
                </tr>
                <tr>
                    <th scope="row">Kota</th>
                    <td>: {{ $pelanggan->kota }}</td>
                </tr>
                <tr>
                    <th scope="row">Provinsi</th>
                    <td>: {{ $pelanggan->provinsi }}</td>
                </tr>
                <tr>
                    <th scope="row">Negara</th>
                    <td>: {{ $pelanggan->negara }} ({{ $pelanggan->kode_negara }})</td>
                </tr>
                <tr>
                    <th scope="row">Zipcode</th>
                    <td>: {{ $pelanggan->zipcode }}</td>
                </tr>
                <tr>
                    <th scope="row">Status Pelanggan</th>
                    <td>
                        : 
                        @if($pelanggan->status_pelanggan === 'Aktif')
                            <span class="badge bg-success">{{ $pelanggan->status_pelanggan }}</span>
                        @else
                            <span class="badge bg-secondary">{{ $pelanggan->status_pelanggan }}</span>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


    @if(auth()->user()->role->name === 'admin')
        <div class="mb-4 mt-3">
            <a href="{{ route('orders.create', ['pelanggan_id' => $pelanggan->id]) }}" class="btn btn-success">
                Tambah Order Baru
            </a>
        </div>
    @endif

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

    @if(auth()->user()->role->name === 'admin')
        <div class="mt-4">
            <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
        </div>
    @endif
</div>
@endsection
