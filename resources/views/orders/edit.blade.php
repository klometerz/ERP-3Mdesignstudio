@extends('layouts.app')

@section('content')
<div class="container">
<div class="d-flex justify-content-between align-items-center mb-4">
    @include('components.breadcrumb')
</div>

<h1 class="h3 mb-4">{{ $title ?? 'Title' }}</h1>


    <form action="{{ route('orders.update', $order->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Pilih Pelanggan</label>
            <select name="pelanggan_id" class="form-control" required>
                @foreach($pelanggan as $item)
                    <option value="{{ $item->id }}" {{ $order->pelanggan_id == $item->id ? 'selected' : '' }}>
                        {{ $item->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Tanggal Order</label>
            <input type="date" name="tanggal_order" class="form-control" value="{{ $order->tanggal_order }}" required>
        </div>

        <div class="mb-3">
            <label>Tanggal Selesai Order</label>
            <input type="date" name="tanggal_selesai_order" class="form-control" value="{{ $order->tanggal_selesai_order }}" required>
        </div>

        <div class="mb-3">
            <label>Nilai Order (Rp)</label>
            <input type="number" name="nilai_order" class="form-control" value="{{ $order->nilai_order }}" required>
        </div>
        <div class="mb-3">
    <label class="form-label">Nama Pekerjaan</label>
    <input type="text" name="nama_pekerjaan" class="form-control">
</div>

<div class="mb-3">
    <label class="form-label">Foto Before</label>
    <input type="file" name="foto_before" class="form-control">
</div>

<div class="mb-3">
    <label class="form-label">Foto After</label>
    <input type="file" name="foto_after" class="form-control">
</div>


        <div class="mb-3">
            <label>Status Order</label>
            <select name="status_order" class="form-control" required>
                <option value="Proses" {{ $order->status_order == 'Proses' ? 'selected' : '' }}>Proses</option>
                <option value="Selesai" {{ $order->status_order == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="Batal" {{ $order->status_order == 'Batal' ? 'selected' : '' }}>Batal</option>
            </select>
        </div>

        <div class="text-end">
            <button class="btn btn-primary">Update Order</button>
        </div>
    </form>
</div>
@endsection
