@extends('layouts.app')

@section('content')
<div class="container">
<div class="d-flex justify-content-between align-items-center mb-4">
    @include('components.breadcrumb')
</div>

<h1 class="h3 mb-4">{{ $title ?? 'Title' }}</h1>


    <form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $pelanggan->nama }}" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $pelanggan->email }}">
        </div>
        <div class="mb-3">
            <label>Telepon</label>
            <input type="text" name="telepon" class="form-control" value="{{ $pelanggan->telepon }}">
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" rows="3" required>{{ $pelanggan->alamat }}</textarea>
        </div>
        <div class="mb-3">
            <label>Kota</label>
            <input type="text" name="kota" class="form-control" value="{{ $pelanggan->kota }}" required>
        </div>
        <div class="mb-3">
            <label>Provinsi</label>
            <input type="text" name="provinsi" class="form-control" value="{{ $pelanggan->provinsi }}">
        </div>
        <div class="mb-3">
            <label>Zipcode</label>
            <input type="text" name="zipcode" class="form-control" value="{{ $pelanggan->zipcode }}">
        </div>
        <div class="mb-3">
            <label>Negara</label>
            <input type="text" name="negara" class="form-control" value="{{ $pelanggan->negara }}">
        </div>
        <div class="mb-3">
            <label>Kode Negara</label>
            <input type="text" name="kode_negara" class="form-control" maxlength="2" value="{{ $pelanggan->kode_negara }}">
        </div>
        <div class="mb-3">
            <label>Status Pelanggan</label>
            <select name="status_pelanggan" class="form-control" required>
                <option value="Aktif" {{ $pelanggan->status_pelanggan == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="Tidak Aktif" {{ $pelanggan->status_pelanggan == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
        </div>

        <div class="text-end">
            <button class="btn btn-primary">Update</button>
        </div>
    </form>
</div>
@endsection
