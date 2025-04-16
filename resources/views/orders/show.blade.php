@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="d-flex justify-content-between align-items-center mb-4">
                @include('components.breadcrumb')
            </div>

            <h1 class="h3 mb-4">{{ $title ?? 'Detail Order' }}</h1>

            <div class="card">
                <div class="card-header">
                    Detail Order
                </div>
                <div class="card-body">
                    <dl class="row">
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
                    </dl>

                    <dt class="col-sm-4">Nama Pekerjaan</dt>
<dd class="col-sm-8">{{ $order->nama_pekerjaan ?? '-' }}</dd>

<dt class="col-sm-4">Foto Before</dt>
<dd class="col-sm-8">
    @if ($order->foto_before)
        <img src="{{ asset('storage/' . $order->foto_before) }}" alt="Foto Before" class="img-fluid" style="max-width: 300px;">
    @else
        -
    @endif
</dd>

<dt class="col-sm-4">Foto After</dt>
<dd class="col-sm-8">
    @if ($order->foto_after)
        <img src="{{ asset('storage/' . $order->foto_after) }}" alt="Foto After" class="img-fluid" style="max-width: 300px;">
    @else
        -
    @endif
</dd>
@if (auth()->check())
    <div class="mt-5">
        <h5>Upload Foto After (Pekerjaan Selesai)</h5>

        <form id="uploadFotoAfterForm" action="{{ route('orders.uploadFotoAfter', $order->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <input type="file" name="foto_after" class="form-control" required>
    </div>
    <button id="submitBtn" type="submit" class="btn btn-primary">Upload Foto After</button>

    <div id="uploadingText" class="text-info mt-2" style="display: none;">
        <strong>Uploading... Please wait ⏳</strong>
    </div>
</form>

    </div>
@endif


                    <div class="text-end">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
