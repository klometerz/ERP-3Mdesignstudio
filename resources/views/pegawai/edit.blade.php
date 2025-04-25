@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
    @include('components.breadcrumb')
</div>
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    Edit Pegawai
                </div>
                <div class="card-body">
                    <form action="{{ route('pegawai.update', $pegawai->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" value="{{ $pegawai->nama }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input type="text" name="jabatan" class="form-control" value="{{ $pegawai->jabatan }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea name="alamat" class="form-control" rows="3" required>{{ $pegawai->alamat }}</textarea>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-warning text-white">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
