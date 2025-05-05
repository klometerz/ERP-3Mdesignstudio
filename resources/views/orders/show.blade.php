@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h3 class="mb-4">{{ $title ?? 'Detail Order' }}</h3>

    <div class="card shadow-sm">
        <div class="card-header">Detail Order</div>
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-4">Nama Pelanggan</dt>
                <dd class="col-sm-8">{{ $order->pelanggan->nama ?? '-' }}</dd>

                <dt class="col-sm-4">Tanggal Order</dt>
                <dd class="col-sm-8">{{ $order->tanggal_order }}</dd>

                <dt class="col-sm-4">Tanggal Selesai</dt>
                <dd class="col-sm-8">{{ $order->tanggal_selesai_order }}</dd>

                <dt class="col-sm-4">Nilai Order</dt>
                <dd class="col-sm-8">Rp {{ number_format($order->nilai_order, 0, ',', '.') }}</dd>

                <dt class="col-sm-4">Status Order</dt>
                <dd class="col-sm-8">{{ $order->status_order }}</dd>

                <dt class="col-sm-4">Nama Pekerjaan</dt>
                <dd class="col-sm-8">{{ $order->nama_pekerjaan ?? '-' }}</dd>

                <dt class="col-sm-4">Foto Before</dt>
                <dd class="col-sm-8">
                    @if ($order->foto_before)
                        <img src="{{ asset('storage/' . $order->foto_before) }}" alt="Foto Before" class="img-thumbnail" style="max-width: 300px;">
                    @else
                        -
                    @endif
                </dd>

                <dt class="col-sm-4">Foto After</dt>
                <dd class="col-sm-8">
                    @if ($order->foto_after)
                        <img src="{{ asset('storage/' . $order->foto_after) }}" alt="Foto After" class="img-thumbnail" style="max-width: 300px;">
                    @else
                        -
                    @endif
                </dd>
            </dl>

            @if (auth()->check() && auth()->user()->role->name === 'admin')
                <div class="mt-5">
                    <h5>Upload Foto After (Pekerjaan Selesai)</h5>
                    <form action="{{ route('orders.uploadFotoAfter', $order->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <input type="file" name="foto_after" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Upload Foto After</button>
                    </form>
                </div>
            @endif

            <div class="text-end mt-4">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
