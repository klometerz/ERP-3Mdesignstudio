@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="d-flex justify-content-between align-items-center mb-4">
                @include('components.breadcrumb')
            </div>

            <h1 class="h3 mb-4">Tambah Order</h1>

            <form id="createOrderForm" action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data">

                @csrf

                @if(isset($pelanggan_id))
                    <input type="hidden" name="pelanggan_id" value="{{ $pelanggan_id }}">
                    <div class="mb-3">
                        <label class="form-label">Pelanggan</label>
                        <input type="text" class="form-control" value="{{ $pelanggan->where('id', $pelanggan_id)->first()->nama }}" disabled>
                    </div>
                @else
                    <div class="mb-3">
                        <label class="form-label">Pilih Pelanggan</label>
                        <select name="pelanggan_id" class="form-control" required>
                            <option value="">-- Pilih Pelanggan --</option>
                            @foreach($pelanggan as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <div class="mb-3">
                    <label class="form-label">Tanggal Order</label>
                    <input type="date" name="tanggal_order" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Selesai Order</label>
                    <input type="date" name="tanggal_selesai_order" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nilai Order (Rp)</label>
                    <input type="number" name="nilai_order" class="form-control" required>
                </div>
                <div class="mb-3">
    <label class="form-label">Nama Pekerjaan</label>
    <input type="text" name="nama_pekerjaan" class="form-control">
</div>

<div class="mb-3">
        <label class="form-label">Foto Before</label>
        <input type="file" name="foto_before" class="form-control" required>
    </div>



                <div class="mb-3">
                    <label class="form-label">Status Order</label>
                    <select name="status_order" class="form-control" required>
                        <option value="Proses">Proses</option>
                        <option value="Selesai">Selesai</option>
                        <option value="Batal">Batal</option>
                    </select>
                </div>

                <div class="text-end">
                <button id="submitCreateBtn" type="submit" class="btn btn-primary">Simpan Order</button>
                </div>
                <div id="uploadingCreateText" class="text-info mt-2" style="display: none;">
        <strong>Uploading... Please wait ⏳</strong>
    </div>
            </form>

        </div>
    </div>
</div>
@endsection
