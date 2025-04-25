@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

     

<h1 class="h3 mb-4">{{ $title ?? 'Title' }}</h1>


            <form action="{{ route('pelanggan.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Telepon</label>
                    <input type="text" name="telepon" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label>Kota</label>
                    <input type="text" name="kota" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Provinsi</label>
                    <input type="text" name="provinsi" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Zipcode</label>
                    <input type="text" name="zipcode" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Negara</label>
                    <input type="text" name="negara" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Kode Negara</label>
                    <input type="text" name="kode_negara" class="form-control" maxlength="2">
                </div>
                <div class="mb-3">
                    <label>Status Pelanggan</label>
                    <select name="status_pelanggan" class="form-control" required>
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                    </select>
                </div>

                <div class="text-end">
                    <button class="btn btn-success">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
